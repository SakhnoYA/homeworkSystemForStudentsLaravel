<?php

namespace App\Http\Controllers;

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
        //создание пользователя 1
    }

    public function createWithoutConfirm()
    {
        //создание пользователя 2
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //сохранение пользователя
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
