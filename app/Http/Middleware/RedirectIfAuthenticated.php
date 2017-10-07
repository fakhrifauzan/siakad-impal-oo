<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->user_level == 'admin') {
                return redirect('/admin/home');
                // return redirect()->route('admin.home');
            } else if (Auth::user()->user_level == 'dosen') {
                return redirect('/dosen/home');
                // return redirect()->route('dosen.home');
            } else if (Auth::user()->user_level == 'mahasiswa') {
                return redirect('/mahasiswa/home');
                // return redirect()->route('mahasiswa.home');
            } else {
                return redirect('/paycheck/home');
                // return redirect()->route('paycheck.home');
            }
        }
        return $next($request);
    }
}
