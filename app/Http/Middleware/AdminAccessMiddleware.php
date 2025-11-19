<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAccessMiddleware
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role;

        $allowedRoles = ['admin_ma', 'admin_mts']; 

        if (!in_array($userRole, $allowedRoles)) {
            return redirect('/')->with('error', 'Akses Admin Ditolak. Peran Anda tidak diizinkan mengakses halaman ini.');
        }

        return $next($request);
    }
}