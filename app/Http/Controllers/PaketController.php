<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class PaketController extends Controller
{
        
    /**
     * Method index
     *
     * @return void
     */
    public function index()
    {
        $paket = Paket::all();
        return view('paket.index', compact('paket'));
    }

        
    /**
     * Method create
     *
     * @return void
     */
    public function create()
    {
        return view('paket.create');
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
        $validasi = $request->validate(
            [
                'nama_paket' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'harga' => 'required',
                'jenis_paket' => 'required',
                'member' => 'required',
                'deskripsi' => 'required',
                'masa_aktif' => 'required',
                'promo' => 'required',
            ],
            [
                'nama_paket.required' => 'Masa Aktif Wajib di Isi',
                'image.required' => 'Gambar Wajib di Isi',
                'image.image' => 'Format File Anda Salah, Harus jpg, png, jpeg',
                'image.max' => 'File Anda Melebihi Kapasitas',
                'harga.required' => 'Harga Paket Wajib di Isi',
                'jenis_paket.required' => 'Jenis paket wajib di Isi',
                'member.required' => 'Members wajib di Isi',
                'deskripsi.required' => 'Deskripsi Wajib di Isi',
                'masa_aktif.required' => 'Masa Aktif Wajib di Isi',
                'promo.required' => 'Promo wajib diisi',
            ]
        );

        if ($request->file('image')) {
            $validasi['image'] = $request->file('image')->store('images');
        }

        Paket::create($validasi);
        return redirect()
            ->route('paket.index')
            ->with('message', 'User berhasil ditambah');
    }
   
        
    /**
     * Method updateStatus
     * Update status dari belum dipublish dan sudah dipublish
     * @param $id $id [explicite description]
     *
     * @return void
     */
    public function updateStatus($id)
    {
        $decryptedId = Crypt::decryptString($id);
        $paket = Paket::where('id', $decryptedId)->first();
        if ($paket->status == 1) {
            $paket->status = 0;
            $paket->save();
        } else {
            $paket->status = 1;
            $paket->save();
        }
        return redirect()
            ->route('paket.index')
            ->with('message', 'Berhasil update status');
    }
    /**
     * Display the specified resource.
     */
    public function show(Paket $paket)
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
        $paket = Paket::find($decryptedId);
        return view('paket.edit', compact('paket'));
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
        $paket = Paket::find($decryptedId);
        $validasi = $request->validate(
            [
                'nama_paket' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg|max:2048',
                'harga' => 'required',
                'jenis_paket' => 'required',
                'member' => 'required',
                'deskripsi' => 'required',
                'masa_aktif' => 'required',
                'promo' => 'required',
            ],
            [
                'nama_paket.required' => 'Masa Aktif Wajib di Isi',
                'image.image' => 'Format File Anda Salah, Harus jpg, png, jpeg',
                'image.max' => 'File Anda Melebihi Kapasitas',
                'harga.required' => 'Harga Paket Wajib di Isi',
                'jenis_paket.required' => 'Jenis paket wajib di Isi',
                'member.required' => 'Members wajib di Isi',
                'deskripsi.required' => 'Deskripsi Wajib di Isi',
                'masa_aktif.required' => 'Masa Aktif Wajib di Isi',
                'promo.required' => 'Promo wajib diisi',
            ]
        );
        if ($request->hasFile('image')) {
            if ($paket->image) {
                Storage::delete($paket->image);
            }
            $validasi['image'] = $request->file('image')->store('images');
        }

        $paket->update($validasi);
        return redirect()
            ->route('paket.index')
            ->with('message', 'User berhasil diubah');
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
        $paket = Paket::find($id);
        if ($paket->image) {
            Storage::delete($paket->image);
        }
        $paket->delete();
        return redirect()
            ->route('paket.index')
            ->with('message', 'Berhasil menghapus paket');
    }
}
