<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Komisi;
use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Method index
     * Fungsi menampilkan halaman dashboard
     * @return void
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        if (Auth::user()->hasRole('contributor-pro') && $user->parent == null) {
            $pembayaran = Pembayaran::where('user_id', $user_id)->latest()->first();
            $tanggal_sekarang = strtotime(date('Y-m-d'));
            $tanggal_aktif = strtotime($pembayaran->tanggal_kadaluwarsa);
            if ($tanggal_sekarang > $tanggal_aktif && $pembayaran->status == 'Success') {
                $user->removeRole('contributor-pro');
                $user->assignRole('contributor');
            }
        }

        if (Auth::user()->hasRole('contributor-pro') && $user->parent != null) {
            $pembayaran = Pembayaran::where('user_id', $user->parent)->latest()->first();
            $tanggal_sekarang = strtotime(date('Y-m-d'));
            $tanggal_aktif = strtotime($pembayaran->tanggal_kadaluwarsa);
            if ($tanggal_sekarang > $tanggal_aktif && $pembayaran->status == 'Success') {
                $user->removeRole('contributor-pro');
                $user->assignRole('contributor');
            }
        }

        $artikel_count = Artikel::where('created_by', $user_id)->count();
        $komisi_count = Komisi::where('user_id', $user_id)->count();

        return view('layouts.index', [
            'artikel_count' => $artikel_count,
            'komisi_count' => $komisi_count,
        ]);
    }
}
