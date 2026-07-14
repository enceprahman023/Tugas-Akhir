<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, \Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        if (Auth::check()) {
            $userRole = Auth::user()->role;
            if ($userRole === 'admin') {
                return redirect()->route('admin.dashboard')->with('error', 'Akses ditolak. Anda tidak memiliki izin ke halaman tersebut.');
            } elseif ($userRole === 'gurubk') {
                return redirect()->route('guru.dashboard')->with('error', 'Akses ditolak. Anda tidak memiliki izin ke halaman tersebut.');
            } else {
                return redirect()->route('pelapor.dashboard')->with('error', 'Akses ditolak. Anda tidak memiliki izin ke halaman tersebut.');
            }
        }

        return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
    }
}
