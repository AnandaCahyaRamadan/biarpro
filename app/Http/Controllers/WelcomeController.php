<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use Illuminate\Support\Facades\Session;

class WelcomeController extends Controller
{    
    /**
     * Method index
     *
     * @return void
     */
    public function index()
    {
        $paket = Paket::where('status', 1)->get();
        return view('welcome', compact('paket'));
    }
    
    /**
     * Method handleReferral
     * handle untuk mengambil referal kode
     * @param $referral $referral [explicite description]
     *
     * @return void
     */
    public function handleReferral($referral)
    {
        Session::put('referral', $referral);
        // dd(Session::get('referral'));

        return redirect('/');
    }
}
