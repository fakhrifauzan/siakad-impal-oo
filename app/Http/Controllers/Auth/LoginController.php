<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    // Defined modified redirect
    protected function redirectTo()
    {
        if (Auth::user()->user_level == 'admin') {
            return '/admin/home';
        } else if (Auth::user()->user_level == 'dosen') {
            return '/dosen/home';
        } else if (Auth::user()->user_level == 'mahasiswa') {
            return '/mahasiswa/home';
        } else {
            return '/paycheck/home';
        }
    }
}
