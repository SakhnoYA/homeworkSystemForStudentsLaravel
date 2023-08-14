<?php

namespace App\Http\Controllers;

use App\Actions\AttachCoursesAction;
use App\Actions\DetachCoursesAction;
use App\Models\Course;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class AccessRequestController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function index()
    {
        $unattachedCourses = Course::whereDoesntHave('users', function ($query) {
            $query->where('users.id', Auth::id());
        })->get();

        return view('common.access_request', ['unattachedCourses' => $unattachedCourses,'user'=>Auth::user()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        AttachCoursesAction $attachCoursesAction,
        DetachCoursesAction $detachCoursesAction,
        string $id
    ) {
        $user = User::find($id);
        $attachCoursesAction($request, $user);
        $detachCoursesAction($request, $user);

        return redirect()->route(Auth::user()->user_type->name . '.index')->with('success', 'Запрос отправлен');
    }


}
