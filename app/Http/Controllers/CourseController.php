<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCourseRequest;
use App\Models\Course;

use Auth;

class CourseController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function create()
    {
        return view('admin.create_course', ['id' => Auth::id()]);
    }

    public function store(CreateCourseRequest $request)
    {
        Course::create(
            $request->except('_token')
        );
        session()->flash('success', 'Курс создан');
        return redirect()->route('admin.index');
    }
}
