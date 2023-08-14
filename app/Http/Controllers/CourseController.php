<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Auth;
use Illuminate\Http\Request;

use function redirect;
use function session;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            Auth::user()->user_type->name . '.index',
            ['confirmedAttachedCourses' => Auth::user()->courses()->wherePivot('is_confirmed', true)->paginate(15)]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view(Auth::user()->user_type->name . '.course', ['course' => Course::find($id), 'id' => Auth::id()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request, string $id)
    {
        $course = Course::find($id);
        $course->update(
            $request->except('_token')
        );
        session()->flash('success', 'Курс обновлен');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
