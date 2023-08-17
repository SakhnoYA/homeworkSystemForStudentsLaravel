<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\RememberMeService;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function dd;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('basic.login');
    }

    public function login(LoginRequest $request, RememberMeService $rememberMeService)
    {
//        $credentials = $request->getCredentials();

//        if(!Auth::validate($credentials)):
//            return redirect()->to('login')
//                ->withErrors(trans('auth.failed'));
//        endif;

//        $user = Auth::getProvider()->retrieveByCredentials($credentials);

//        Auth::login($user, $request->get('remember'));
        if (Auth::attempt([
            'id' => $request->get('login'),
            'password' => $request->get('password'),
        ], $request->get('remember'))) {
//            if (Auth::user()->is_admin) {
//                return redirect()->route('admin.index');
//            } else {
//                return redirect()->home();
//            }
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
