<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\KategoriBisnis;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
        
    /**
     * Method index
     *
     * @return void
     */
    public function index()
    {
        if (Auth::user()->hasRole(['super-admin'])) {
            $user = User::all();
            return view('user.index', compact('user'));
        }
        if (Auth::user()->hasRole(['contributor-pro'])) {
            $user = User::where('parent', Auth::user()->id)->get();
            return view('user.index', compact('user'));
        }
    }

        
    /**
     * Method create
     *
     * @return void
     */
    public function create()
    {
        if (Auth::user()->hasRole(['super-admin'])) {
            $role = Role::all();
            $kategori_bisnis = KategoriBisnis::all();
            return view('user.create', compact('kategori_bisnis', 'role'));
        }
        if (Auth::user()->hasRole(['contributor-pro'])) {
            $jumlah_member = User::where('id', Auth::user()->id)
                ->pluck('member')
                ->first();
            $member = User::where('parent', Auth::user()->id)
                ->get()
                ->count();
            // dd($member);
            if ($member < $jumlah_member - 1) {
                $role = 'contributor-pro';
                $kategori_bisnis = Auth::user()->kategori_bisnis;
                return view('user.create', compact('kategori_bisnis', 'role'));
            } else {
                return redirect()
                    ->back()
                    ->with('error', 'Member melebihi batas');
            }
        }
    }

        
    /**
     * Method store
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'role' => ['required'],
                'link_website' => ['nullable'],
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['nullable', 'string', 'max:255'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    'unique:users',
                ],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'no_personal' => ['required'],
                'no_bisnis' => ['nullable'],
                'alamat' => ['required'],
                'kategori_bisnis_id' => ['required'],
            ],
            [
                'role.required' => 'Role harus dipilih.',
                'first_name.required' => 'Nama depan harus diisi.',
                'last_name.required' => 'Nama belakang harus diisi.',
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
                'password.required' => 'Password harus diisi.',
                'password.min' =>
                    'Password minimal harus terdiri dari 8 karakter.',
                'password.confirmed' => 'Konfirmasi password tidak cocok.',
                'no_personal.required' => 'Nomor personal harus diisi.',
                'alamat.required' => 'Alamat harus diisi.',
                'kategori_bisnis_id.required' =>
                    'Kategori bisnis harus dipilih.',
            ]
        );

        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->link_website = $request->input('link_website');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->no_personal = $request->input('no_personal');
        $user->no_bisnis = $request->input('no_bisnis');
        $user->alamat = $request->input('alamat');
        $user->kategori_bisnis_id = $request->input('kategori_bisnis_id');
        $user->affiliate_code = $this->generateAffiliateCode();
        if (Auth::user()->hasRole(['contributor-pro'])) {
            $user->parent = Auth::user()->id;
        }
        $user->assignRole($request->input('role'));
        $user->save();
        return redirect()
            ->route('user.index')
            ->with('message', 'User berhasil ditambah');
    }
    
    /**
     * Method edit
     *
     * @param $id $id [explicite description]
     *
     * @return void
     */
    public function edit($id)
    {
        $decryptedId = Crypt::decryptString($id);
        $user = User::find($decryptedId);
        $role = Role::all();
        $kategori_bisnis = KategoriBisnis::all();

        return view('user.edit', compact('kategori_bisnis', 'user', 'role'));
    }
    
    /**
     * Method update
     *
     * @param Request $request [explicite description]
     * @param $id $id [explicite description]
     *
     * @return void
     */
    public function update(Request $request, $id)
    {
        $decryptedId = Crypt::decryptString($id);
        $validated = $request->validate(
            [
                'role' => ['required'],
                'link_website' => ['nullable'],
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['nullable', 'string', 'max:255'],
                'email' => 'required|unique:users,email,' . $decryptedId,
                'password' => 'sometimes|nullable|confirmed',
                'no_personal' => ['required'],
                'no_bisnis' => ['nullable'],
                'alamat' => ['required'],
                'kategori_bisnis_id' => ['required'],
            ],
            [
                'role.required' => 'Nama role harus diisi.',
                'first_name.required' => 'Nama depan harus diisi.',
                'last_name.required' => 'Nama belakang harus diisi.',
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
                'password.required' => 'Password harus diisi.',
                'password.min' =>
                    'Password minimal harus terdiri dari 8 karakter.',
                'password.confirmed' => 'Konfirmasi password tidak cocok.',
                'no_personal.required' => 'Nomor personal harus diisi.',
                'alamat.required' => 'Alamat harus diisi.',
                'kategori_bisnis_id.required' =>
                    'Kategori bisnis harus dipilih.',
            ]
        );

        $user = User::find($decryptedId);
        $roles = $user->getRoleNames();
        $user->removeRole($roles[0]);
        $user->assignRole($request->input('role'));
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->link_website = $request->input('link_website');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->no_personal = $request->input('no_personal');
        $user->no_bisnis = $request->input('no_bisnis');
        $user->alamat = $request->input('alamat');
        $user->kategori_bisnis_id = $request->input('kategori_bisnis_id');
        $user->update();

        return redirect()
            ->route('user.index')
            ->with('message', 'User berhasil diperbarui');
    }
    
    /**
     * Method destroy
     *
     * @param Request $request [explicite description]
     * @param $id $id [explicite description]
     *
     * @return void
     */
    public function destroy(Request $request, $id)
    {
        $user = User::find($id);
        if ($id == $request->user()->id) {
            return redirect()
                ->route('user.index')
                ->with('error', 'Anda tidak dapat menghapus diri sendiri');
        }

        $user->delete();
        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil dihapus');
    }
    
    /**
     * Method generateAffiliateCode
     * Fungsi untuk membuat code affiliate
     * @return void
     */
    public function generateAffiliateCode()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $code = '';
        $length = 10;

        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $code .= $characters[$index];
        }

        return $code;
    }
}
