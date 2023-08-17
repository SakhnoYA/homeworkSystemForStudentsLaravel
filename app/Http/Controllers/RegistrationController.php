<?php

namespace App\Http\Controllers;

use App\Models\User;
use Cache;
use Illuminate\Http\Request;


class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.registrations', [
            'users' => User::where(
                ['is_confirmed' => false]
            )->with('user_type')->paginate(config('constants.options.paginate_number'))
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        User::find($id)->update($request->input());

        return redirect()->back()->with('success', 'Регистрация подтверждена');
    }

    public function create()
    {
        return view('basic.registration');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);

        return redirect()->back()->with('success', 'Регистрация удалена');
    }

    public function destroyAll()
    {
        if (!User::where(
            ['is_confirmed' => false]
        )->delete()) {
            return redirect()->back();
        }

        Cache::flush();

        return redirect()->back()->with('success', 'Неподтвержденные регистрации удалены');
    }
}
