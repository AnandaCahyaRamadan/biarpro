<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Komisi;
use App\Models\Paket;
use App\Models\Pembayaran;
use App\Models\User;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;

class PembayaranController extends Controller
{

    /**
     * Method index
     *
     * @return void
     */
    public function index()
    {
        $pembayarans = Pembayaran::all();
        return view('pembayaran.index', compact('pembayarans'));
    }

    /**
     * Method checkout
     * Fungsi untuk melakukan checkout dimana akan mengambil token dari midtrans
     * @param Request $request [explicite description]
     * @param $id $id [id merupakan id dari paket yang dipilih]
     *
     * @return view
     */
    public function checkout(Request $request, $id)
    {
        // Set your Merchant Server Key
        Config::$serverKey = 'SB-Mid-server-dnQZ1emZT-FW8tr3Qg3ZCgBi';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = false;
        // Set sanitization on (default)
        Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        Config::$is3ds = true;

        if (Auth::user() == null) {
            return redirect('/login')->with(
                'success',
                'Pembayaran berhasil disimpan.'
            );
        }

        $decryptedId = Crypt::decryptString($id);
        $paket = Paket::where('id', $decryptedId)->first();
        // Proses pembayaran dan buat request ke API Midtrans
        $order_id = uniqid();
        $params = [
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $paket->harga, // ganti dengan total pembayaran sesuai dengan produk/layanan Anda
            ],
            'customer_details' => [
                'first_name' => Auth::user()->first_name,
                'last_name' => Auth::user()->last_name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->no_personal,
            ],
            'callbacks' => [
                'finish' => route('notification', [
                    'id' => $order_id,
                    'idPaket' => $paket->id,
                ]),
                'fail' => redirect('/dashboard'),
            ],
        ];

        $snapToken = Snap::getSnapToken($params);
        $tanggal = date('Y-m-d');
        $tanggal_awal = new DateTime($tanggal);
        $pembayaran = new Pembayaran();
        $pembayaran->order_id = $order_id;
        $pembayaran->user_id = Auth::user()->id;
        $pembayaran->total_pembayaran = $paket->harga;
        $pembayaran->metode_pembayaran = '';
        $pembayaran->tanggal_pembayaran = $tanggal;
        $day = new DateInterval("P{$paket->masa_aktif}D");
        $nama_paket = $paket->nama_paket;
        $image = $paket->image;
        $total = $paket->harga;
        $pembayaran->tanggal_kadaluwarsa = $tanggal_awal->add($day)->format('Y-m-d');
        $pembayaran->status = '';
        $pembayaran->tokens = $snapToken;
        $pembayaran->save();
        return view(
            'checkout',
            compact('pembayaran', 'nama_paket', 'image', 'snapToken', 'total')
        );
    }

    /**
     * Method callback
     * Fungsi untuk mengambil status pembayaran dari midtrans
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function callback(Request $request)
    {
        $serverKey = 'SB-Mid-server-dnQZ1emZT-FW8tr3Qg3ZCgBi';
        $hashed = hash(
            'sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );
        if ($hashed == $request->signature_key) {
            if (
                $request->transaction_status == 'capture' or
                $request->transaction_status == 'settlement'
            ) {
                $pembayaran = Pembayaran::where('order_id', $request->order_id);
                $pembayaran->update([
                    'status' => 'Success',
                    'metode_pembayaran' => $request->payment_type,
                ]);
                $pembayaran = Pembayaran::where(
                    'order_id',
                    $request->order_id
                )->first();
                $user = User::where('id', $pembayaran->user_id)->first();
                $user->removeRole('contributor');
                $user->assignRole('contributor-pro');
            }
            if ($request->transaction_status == 'failure') {
                $pembayaran = Pembayaran::where('order_id', $request->order_id);
                $pembayaran->update(['status' => 'Failed']);
            }
            if ($request->transaction_status == 'pending') {
                $pembayaran = Pembayaran::where('order_id', $request->order_id);
                $pembayaran->update(['status' => 'Pending']);
            }
        }
    }

    /**
     * Method notification
     * Fungsi notification untuk handle setelah pembayaran sukses
     * @param Request $request [explicite description]
     * @param $id $id [merupakan order id dari pembayaran]
     * @param $idPaket $idPaket [merupakan id dari paket yang dibayar]
     *
     * @return void
     */
    public function notification(Request $request, $id, $idPaket)
    {
        $Pembayaran = Pembayaran::where('order_id', $id)
            ->pluck('status')
            ->first();
        if ($Pembayaran == 'Success') {
            $referral = Session::get('referral');
            $user = User::where('affiliate_code', $referral)->first();
            if ($user) {
                $user->refferal_count += 1;
                $user->save();
            }
            $user = User::where('affiliate_code', $referral)
                ->pluck('id')
                ->first();
            $pembayaran = Pembayaran::where('user_id', Auth::user()->id)
                ->pluck('id')
                ->first();
            $komisi = new Komisi();
            $komisi->user_id = $user;
            $komisi->pembayaran_id = $pembayaran;
            $komisi->tanggal = date('Y-m-d');
            $komisi->status = false;
            $komisi->save();
            $member = Paket::where('id', $idPaket)
                ->pluck('member')
                ->first();
            $user = User::where('id', Auth::user()->id)->first();
            $user->refferal_code = $referral;
            $user->member = $member;
            $user->save();
        }

        return redirect('/dashboard');
    }

    /**
     * Method destroy
     *
     * @return void
     */
    public function destroy()
    {
        $pembayaran = Pembayaran::where('user_id', Auth::user()->id);
        $pembayaran->delete();

        return redirect()
            ->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil dihapus.');
    }
}
