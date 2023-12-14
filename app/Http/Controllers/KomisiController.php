<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Komisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class KomisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole(['super-admin', 'admin'])) {
            $komisi = Komisi::all();
        } else {
            $komisi = Komisi::where('user_id', Auth::user()->id)->get();
        }
        return view('komisi.index', compact('komisi'));
    }

    /**
     * Method updateStatus
     * Update status dari belum dicairkan ke sudah dicairkan
     * @param $id $id [explicite description]
     *
     * @return void
     */
    public function updateStatus($id)
    {
        $decryptedId = Crypt::decryptString($id);
        $komisi = Komisi::where('id', $decryptedId)->first();
        if ($komisi->status == 0) {
            $komisi->status = 1;
            $komisi->save();
        }
        return redirect()
            ->route('paket.index')
            ->with('message', 'Berhasil update status');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
