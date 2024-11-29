<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __invoke() {
        auth()->logout();

        return to_route('login');
    }
}
