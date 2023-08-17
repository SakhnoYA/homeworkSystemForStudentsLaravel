<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomeworkRequest;
use App\Models\Homework;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view(
            Auth::user()->user_type->name . '.homework',
            [
                'homework' => Homework::find($request->get('homework_id')),
                'id' => Auth::id(),
                'course_id' => $request->input('course_id')
            ]
        );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(HomeworkRequest $request)
    {
        $homework = Homework::create([
            'title' => $request['hw_title'],
            'description' => $request['hw_description'],
            'max_attempts' => $request['hw_max_attempts'],
            'total_marks' => $request['hw_total_marks'],
            'passing_marks' => $request['hw_passing_marks'],
            'start_date' => $request['hw_start_date'],
            'end_date' => $request['hw_end_date'],
            'updated_by' => $request['updated_by'],
            'created_by' => $request['created_by'],
            'course_id' => $request['course_id']
        ]);

        return redirect()->route(
            'homework.index',
            ['course_id' => $request['course_id'], 'homework_id' => $homework['id']]
        )->with(
            'success',
            'Домашнее задание создано'
        );
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(HomeworkRequest $request, string $id)
    {
        Homework::find($id)->update([
            'title' => $request['hw_title'],
            'description' => $request['hw_description'],
            'max_attempts' => $request['hw_max_attempts'],
            'total_marks' => $request['hw_total_marks'],
            'passing_marks' => $request['hw_passing_marks'],
            'start_date' => $request['hw_start_date'],
            'end_date' => $request['hw_end_date'],
            'updated_by' => $request['updated_by']
        ]);

        return redirect()->route('homework.index', ['homework_id' => $id, 'course_id' => $request['course_id']])->with(
            'success',
            'Изменения сохранены'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Homework::destroy($id);
        return redirect()->back()->with('success', 'Домашнее задание удалено');
    }
}
