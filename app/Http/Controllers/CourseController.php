<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            Auth::user()->user_type->name . '.index',
            [
                'confirmedAttachedCourses' => Auth::user()->courses()->wherePivot('is_confirmed', true)->paginate(
                    config('constants.options.paginate_number')
                )
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view(Auth::user()->user_type->name . '.course', ['course' => Course::find($id), 'id' => Auth::id()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request, string $id)
    {
        Course::find($id)->update($request->except('_token'));

        session()->flash('success', 'Курс обновлен');
        return redirect()->back();
    }

}
