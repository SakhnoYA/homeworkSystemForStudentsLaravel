<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('basic.login');
    }

    public function login(LoginRequest $request)
    {
    }

}
