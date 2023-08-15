<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Validator;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(TaskRequest $request)
    {
        Task::create($request->except('_token'));

        return redirect()->route(
            'homework.index',
            ['course_id' => $request['course_id'], 'homework_id' => $request['homework_id']]
        )->with(
            'success',
            'Задача создана'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        $dataRequest = new TaskRequest;

        session()->flash('old_task_form_' . $id, $request->all());
        session()->flash('empty_old_for_create_task_form', '');

        Validator::make(
            $request->except('_token'),
            $dataRequest->rules(),
            $dataRequest->messages()
        )->validateWithBag('task_form_' . $id);

        session()->forget('old_task_form_' . $id);
        session()->forget('empty_old_for_create_task_form');

        $data = $request->except('_token');
        $data['options'] = preg_replace('!\s+!', ' ', $data['options']);
        $data['answer'] = preg_replace('!\s+!', ' ', $data['answer']);

        Task::find($id)->update($data);

        return redirect()->route(
            'homework.index',
            ['course_id' => $request['course_id'], 'homework_id' => $request['homework_id']]
        )->with(
            'success',
            'Задача обновлена'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        Task::destroy($id);

        return redirect()->route(
            'homework.index',
            ['course_id' => $request['course_id'], 'homework_id' => $request['homework_id']]
        )->with(
            'success',
            'Задача удалена'
        );
    }
}
