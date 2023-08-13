<?php

namespace App\Http\Controllers;

use App\Http\Filters\UserFilter;
use App\Models\User;
use Illuminate\Http\Request;

use function dd;
use function redirect;
use function view;

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
            )->with('user_type')->paginate(15)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->update($request->input());

        return redirect()->back()->with('success', 'Регистрация подтверждена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'Регистрация удалена');
    }

    public function destroyAll()
    {
        if (!User::where(
            ['is_confirmed' => false]
        )->delete()) {
            return redirect()->back();
        }
        return redirect()->back()->with('success', 'Неподтвержденные регистрации удалены');
    }
}
