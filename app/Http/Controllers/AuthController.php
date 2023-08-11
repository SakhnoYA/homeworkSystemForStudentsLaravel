<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('basic.login');
    }

    public function login(LoginRequest $request)
    {
        dd($request);
    }

}
