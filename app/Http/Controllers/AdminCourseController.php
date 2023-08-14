<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Auth;


class AdminCourseController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function create()
    {
        return view('admin.create_course', ['id' => Auth::id()]);
    }

    public function store(CourseRequest $request)
    {
        Course::create(
            $request->except('_token')
        );
        session()->flash('success', 'Курс создан');
        return redirect()->route('admin.index');
    }
}
