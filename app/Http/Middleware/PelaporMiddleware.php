<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PelaporMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('login_pelapor')) {
            return redirect()->route('login')->withErrors(['email' => 'Silakan login terlebih dahulu.']);
        }

        return $next($request);
    }
}
