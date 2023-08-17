<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\RememberMeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('basic.login');
    }

    public function login(LoginRequest $request, RememberMeService $rememberMeService)
    {
        if (Auth::attempt([
            'id' => $request->get('login'),
            'password' => $request->get('password'),
        ], $request->get('remember'))) {
            if ($request->get('remember')) {
                $rememberMeService->setRememberMeExpiration(Auth::user());
            }

            if (isset(Auth::user()->image)) {
                Storage::disk('local')->put('app/public/avatar', Storage::disk('sftp')->get(Auth::user()->image));
            }

            return redirect()->route(Auth::user()->user_type->path . '.index');
        }

        return redirect()->back()->withErrors(['error' => 'Неверные входные данные']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
