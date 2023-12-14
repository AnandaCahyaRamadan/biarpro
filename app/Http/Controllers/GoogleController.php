<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Method redirectToGoogle
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Method handleGoogleCallback
     * Fungsi login dengan google login
     *
     * @return void
     */
    public function handleGoogleCallback()
{
    try {
        $user = Socialite::driver('google')->user();
        $findUser = User::where('email', $user->email)->first();

        if ($findUser) {
            $token = JWTAuth::fromUser($findUser);
            Auth::login($findUser);

            return redirect('/dashboard')->header('Authorization', 'Bearer ' . $token);
        } else {
            $newUser = new User();
            $newUser->email = $user->email;
            $newUser->password = ''; // Set the password or use another field
            $newUser->email_verified_at = now();
            $newUser->affiliate_code = $this->generateAffiliateCode();
            $newUser->save();
            $newUser->assignRole('contributor');

            $token = JWTAuth::fromUser($newUser);
            Auth::login($newUser);

            return redirect('/dashboard')->header('Authorization', 'Bearer ' . $token);
        }
    } catch (Exception $e) {
        // Handle exception if needed
        return redirect()->route('register')->withErrors(['email' => 'Terjadi masalah saat autentikasi dengan Google.']);
    }
}


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
