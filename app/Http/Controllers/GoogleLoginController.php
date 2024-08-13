<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('email', $googleUser->email)->first();

        if (!$user) {
            // Email tidak ditemukan, tampilkan pesan dan alihkan ke halaman login
            Session::flash('alert', 'Email tidak terdaftar. Silakan daftar terlebih dahulu.');
            return redirect('/'); // Mengarahkan ke rute halaman login
        }

        // Email ditemukan, login pengguna
        Auth::login($user);

        // Arahkan ke /landingpage
        return redirect()->route('welcome');
    }
}
