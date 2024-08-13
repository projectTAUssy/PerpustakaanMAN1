<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
    
        $request->session()->regenerate();
    
        // Ambil role_id dari pengguna yang sedang login
        $role_id = Auth::user()->role_id;
    
        // Periksa role_id dan arahkan ke halaman yang sesuai
        if ($role_id == 1) {
            return redirect()->intended('/dashboard');
        } elseif ($role_id == 2) {
            return redirect()->intended('/landingpage');
        } else {
            // Arahkan ke halaman default jika role_id tidak dikenal
            return redirect()->intended('/');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
