<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RoleController extends Controller
{
        
    /**
     * Method index
     *
     * @return void
     */
    public function index()
    {
        $role = Role::all();
        return view('role.index', compact('role'));
    }

        
    /**
     * Method create
     *
     * @return void
     */
    public function create()
    {
        $role = Role::all();
        return view('role.create', compact('role'));
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
        $request->validate(
            [
                'name' => 'required|unique:roles',
                'guard_name' => 'required',
            ],
            [
                'name.required' => 'Nama tidak boleh kosong!',
                'name.unique' => 'Nama role tidak boleh sama!',
            ]
        );

        Role::create($request->all());

        return redirect()
            ->route('role.index')
            ->with('message', 'Role Berhasil ditambah');
    }

        
    /**
     * Method show
     *
     * @param string $id [explicite description]
     *
     * @return void
     */
    public function show(string $id)
    {
        //
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
        $role = Role::find($decryptedId);
        return view('role.edit', compact('role'));
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
        $role = Role::find($decryptedId);
        $validated = $request->validate(
            [
                'name' => 'required|unique:roles,name,' . $decryptedId,
                'guard_name' => 'required',
            ],
            [
                'name.required' => 'Nama tidak boleh kosong!',
                'name.unique' => 'Nama role tidak boleh sama!',
            ]
        );
        $role->update($validated);
        return redirect()
            ->route('role.index')
            ->with('message', 'Role berhasil diperbarui');
    }

        
    /**
     * Method destroy
     *
     * @param $id $id [explicite description]
     *
     * @return void
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect()->route('role.index');
    }
}
