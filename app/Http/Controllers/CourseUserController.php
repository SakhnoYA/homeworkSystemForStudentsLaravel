<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CourseUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.access_requests', [
            'courseRelationships' => Course::whereHas('users', function ($query) {
                $query->where('course_user.is_confirmed', false);
            })->with([
                'users' => function ($query) {
                    $query->wherePivot('is_confirmed', false);
                },
                'users.user_type',
            ])->paginate(config('constants.options.paginate_number')),
        ]);
    }

    public function update(Request $request, int $user_id)
    {
        User::find($user_id)->courses()->updateExistingPivot($request->input('course_id'), ['is_confirmed' => true]);

        return redirect()->route('course_user.index')->with('success', 'Запрос одобрен');
    }

    public function destroy(Request $request, int $user_id)
    {
        User::find($user_id)->courses()->detach($request->input('course_id'));

        return redirect()->route('course_user.index')->with('success', 'Запрос отклонен');
    }
}
