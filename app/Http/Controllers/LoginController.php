<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if(Auth::user()->role === 'kasir') {
                return redirect()->intended('dashboard/kasir');
            }

            return redirect()->intended('dashboard/core');

        }

        return back()->withErrors([
            'loginError' => 'Username or password is incorrect.',
        ])->withInput();
    }
}
