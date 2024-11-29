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

            // intended() fungsinya security check yang berkorelasi dengan middleware('auth'). 
            // Jika user belum login di halaman yang diberikan middleware('auth') maka user tidak bisa masuk ke halaman yang diberi intended 
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'username' => 'Invalid username',
            'password' => 'Invalid password',
        ]);
    }
}
