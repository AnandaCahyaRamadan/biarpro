<?php

namespace App\Http\Controllers;

use App\Models\KataPembuka;
use Illuminate\Http\Request;
use App\Models\KategoriBisnis;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class RefKataPembukaController extends Controller
{
        
    /**
     * Method index
     *
     * @return void
     */
    public function index()
    {
        $data = KataPembuka::orderBy('created_at', 'desc')->get();
        return view('ref_kata_pembuka.index', compact('data'));
    }

        
    /**
     * Method create
     *
     * @return void
     */
    public function create()
    {
        $kategori = KategoriBisnis::all();
        return view('ref_kata_pembuka.create', compact('kategori'));
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
                'kategori' => 'required',
                'kata_pembuka' => 'required',
            ],
            [
                'kata_pembuka.required' => 'Kata pembuka harus di isi.',
                'kategori.required' => 'Kategori bisnis harus di pilih.',
            ]
        );

        KataPembuka::create($request->all());

        return redirect()
            ->route('ref_kata_pembuka.index')
            ->with('message', 'Kata Pembuka berhasil ditambah');
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
        $kataPembuka = KataPembuka::find($id);

        return view('ref_kata_pembuka.show', compact('kataPembuka'));
    }

        
    /**
     * Method edit
     *
     * @param string $id [explicite description]
     *
     * @return void
     */
    public function edit(string $id)
    {
        $decryptedId = Crypt::decryptString($id);
        $kataPembuka = KataPembuka::find($decryptedId);
        $kategori = KategoriBisnis::all();
        return view(
            'ref_kata_pembuka.edit',
            compact('kataPembuka', 'kategori')
        );
    }

        
    /**
     * Method update
     *
     * @param Request $request [explicite description]
     * @param string $id [explicite description]
     *
     * @return void
     */
    public function update(Request $request, string $id)
    {
        $decryptedId = Crypt::decryptString($id);
        $request->validate(
            [
                'kategori' => 'required',
                'kata_pembuka' => 'required',
            ],
            [
                'kata_pembuka.required' => 'Kata pembuka harus di isi.',
                'kategori.required' => 'Kategori bisnis harus di pilih.',
            ]
        );

        $kataPembuka = KataPembuka::find($decryptedId);
        $kataPembuka->update($request->all());

        return redirect()
            ->route('ref_kata_pembuka.index')
            ->with('message', 'Kata Pembuka berhasil diperbarui.');
    }

        
    /**
     * Method destroy
     *
     * @param string $id [explicite description]
     *
     * @return void
     */
    public function destroy(string $id)
    {
        $kataPembuka = KataPembuka::find($id);
        $kataPembuka->delete();

        return redirect()
            ->route('ref_kata_pembuka.index')
            ->with('message', 'Kata Pembuka berhasil dihapus.');
    }
}
