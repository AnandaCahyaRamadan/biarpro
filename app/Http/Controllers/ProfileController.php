<?php

namespace App\Http\Controllers;

use App\Models\KategoriBisnis;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProfileController extends Controller
{
    /**
     * Method edit
     *
     * @param $id $id [id dari user]
     *
     * @return void
     */
    public function edit($id)
    {
        $decryptedId = Crypt::decryptString($id);
        $profile = User::find($decryptedId);
        $role = Role::all();
        $kategori_bisnis = KategoriBisnis::all();

        return view(
            'profile.edit',
            compact('kategori_bisnis', 'profile', 'role')
        );
    }

    /**
     * Method update
     *
     * @param Request $request [explicite description]
     * @param $id $id [id dari user]
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
            ->back()
            ->with('message', 'Profil berhasil diperbarui');
    }
}
