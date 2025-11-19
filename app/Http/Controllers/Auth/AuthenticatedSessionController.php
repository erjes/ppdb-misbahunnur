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
    public function student() : View
    {
        return view('auth.login-student');
    }


    public function create() : View
    {
        return view('auth.login');
    }
    
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string'], // Nomor Pendaftaran
            'password' => ['required', 'string'], // NISN
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            return redirect()->route('registration.status'); 
        }
    
        return back()->withErrors([
            'email' => 'Nomor Pendaftaran atau NISN tidak sesuai.',
        ])->onlyInput('email');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        session()->regenerate();

        if (Auth::user()->role === 'admin_mts' || Auth::user()->role === 'admin_ma') {
            return redirect()->intended(route('admin.registrations.registrant', absolute: false));
        }

        return redirect()->intended(route('home', absolute: false));
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
