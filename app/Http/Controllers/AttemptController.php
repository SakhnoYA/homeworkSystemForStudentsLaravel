<?php

namespace App\Http\Controllers;

use App\Models\Attempt;
use App\Models\Task;
use Auth;
use Illuminate\Http\Request;
use Str;



class AttemptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('teacher.homework_results', [
            'attempts' => Attempt::selectRaw(
                'ROW_NUMBER() OVER(PARTITION BY homework_id, user_id) AS row_number, *'
            )->where('homework_id', $request['homework_id'])->with('user')->paginate(config('constants.options.paginate_number'))
        ]);
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
//        dd($request->all());
        $attempt = Attempt::create(
            [
                'user_id' => Auth::id(),
                'homework_id' => $request['homework_id'],
                'course_id' => $request['course_id'],
            ]
        );

//        DB::table('attempt_homework_user')->insert(
//            [
//                'user_id' => Auth::id(),
//                'homework_id' => $request->get('homework_id'),
//                'attempt_id' => $attempt->id
//            ]
//        );

        $data = $request->except(['_token', 'homework_id', 'course_id']);
        for ($i = 0; $i < count($data) / 2; $i++) {
//            dd($data);
            $input_body = $data['body' . $i];
            if (is_array($input_body)) {
                $input_body = array_map(fn($word) => Str::lower($word), $input_body);
            } else {
//                dump($input_body);
                $input_body = Str::lower($input_body);
//                dump($input_body);
            }

            $task_id = $data['task_id' . $i];

            $task = Task::find($task_id);

            $correctAnswer = array_map(fn($word) => strtolower(str_replace('"', '', $word)),
                explode(' ', $task->answer));

            if ($task->type === 'multiple_choice') {
                $isCorrect = $input_body == $correctAnswer;
                $input_body = implode(' ', $input_body);
            } elseif ($task->type === 'single_choice' || $task->type === 'word_match') {
//                if($task->type === 'word_match'){
//                    dd($input_body, $correctAnswer);
//                }
                $isCorrect = in_array($input_body, $correctAnswer);
            } else {
                $isCorrect = false;
            }

            $attempt->inputs()->create([
                'body' => $input_body,
                'is_correct' => $isCorrect,
                'attempt_id' => $attempt->id,
                'task_id' => $task_id
            ]);
        }

        $score = $attempt->inputs->where('is_correct', true)->sum('task.score');
        $attempt->score = $score;
        $attempt->save();

        return redirect()->route('attempt.show', $attempt->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
//        dd(Attempt::with('inputs', 'inputs.tasks')->where('id', $id)->first());
        return view(
            'common.result_homework',
            ['attempt' => Attempt::with('inputs', 'inputs.task')->where('id', $id)->first()]
        );
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
