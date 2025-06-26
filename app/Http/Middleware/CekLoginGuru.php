<?php

namespace App\Http\Middleware;

use Closure;

class CekLoginGuru
{
    public function handle($request, Closure $next)
    {
        if (!session()->has('login_guru')) {
            return redirect('/login-guru');
        }

        return $next($request);
    }
}
