<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriBisnis;
use Illuminate\Support\Facades\Crypt;

class KategoriBisnisController extends Controller
{
        
    /**
     * Method index
     *
     * @return void
     */
    public function index()
    {
        $kategori_bisnis = KategoriBisnis::all();
        return view('kategoribisnis.index', compact('kategori_bisnis'));
    }

        
    /**
     * Method create
     *
     * @return void
     */
    public function create()
    {
        $kategori_bisnis = KategoriBisnis::all();
        return view('kategoribisnis.create', compact('kategori_bisnis'));
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
                'name' => 'required|max:255',
            ],
            [
                'name.required' => 'Nama kategori tidak boleh kosong!',
            ]
        );

        KategoriBisnis::create($request->all());

        return redirect()
            ->route('kategoribisnis.index')
            ->with('message', 'Kategori berhasil ditambah');
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
        $kategori_bisnis = KategoriBisnis::find($decryptedId);
        return view('kategoribisnis.edit', compact('kategori_bisnis'));
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
        $kategori = KategoriBisnis::find($decryptedId);
        $validated = $request->validate(
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'Nama kategori tidak boleh kosong!',
            ]
        );
        $kategori->update($validated);
        return redirect()
            ->route('kategoribisnis.index')
            ->with('message', 'Kategori berhasil diperbarui');
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
        $kategori_bisnis = KategoriBisnis::find($id);
        $kategori_bisnis->delete();
        return redirect()->route('kategoribisnis.index');
    }
}
