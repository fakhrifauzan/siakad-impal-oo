<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Dosen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if (Auth::check()) {
          if (Auth::user()->user_level != 'dosen') {
            // return abort(404, 'Unauthorized action.');
            return redirect(Auth::user()->user_level);            
          }
      } else {
          return redirect('/');
      }
      return $next($request);
    }
}
