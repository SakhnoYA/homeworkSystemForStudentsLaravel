<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //отображение всех пользователей с категоризацией
//        return view('user.index', [
//            'users' => DB::table('users')->paginate(15)
//        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }
    public function register()
    {
        return view('basic.registration');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegistrationRequest $request)
    {
        $user = User::create([
            'id'=> $request->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'middle_name' => $request->middle_name,
            'password' => $request->password,
            'user_type_id' => $request->user_type_id,
            'ip' => $request->ip(),
//            'is_confirmed' => false,
//            'remember_token' => $request->word(),
//            'created_at' => now(),
//            'updated_at' => now(),
//            'deleted_at' => null,
        ]);

        session()->flash('success', 'Заявка на регистрацию отправлена');
        return redirect()->route('login');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // показать одного пользователя
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // показать одного пользователя
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // обновить одного пользователя
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // удалить одного пользователя
    }
}
