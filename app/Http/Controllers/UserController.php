<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

use function dd;
use function redirect;
use function session;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('admin.index', [
            'users' => User::when($request->has('type'), function ($query) use ($request) {
                $query->where('user_type_id', $request->input('type'));
            })->with('user_type')->paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create_user',['courses' => Course::all()]);
    }

    public function register()
    {
        return view('basic.registration');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegistrationRequest $request)
    {
//        $user = User::create([
//            'id' => $request->get('id'),
//            'first_name' => $request->get('first_name'),
//            'last_name' => $request->get('last_name'),
//            'middle_name' => $request->get('middle_name'),
//            'password' => $request->get('password'),
//            'user_type_id' => $request->get('user_type_id'),
//            'ip' => $request->ip(),
//            'is_confirmed' => $request->get('is_confirmed') ?? false,
//        ]);

        $user = User::create($request->except('_token'));

        if ($request->has('attachCourses')) {
            foreach ($request->input('attachCourses') as $course) {
                $user->courses()->attach($course, ['is_confirmed' => true]);
            }
        }

        if(!$request->get('is_confirmed')){
            session()->flash('success', 'Заявка на регистрацию отправлена');
            return redirect()->route('login');
        }
        session()->flash('success', 'Пользователь создан');
        return redirect()->route('admin.index');
    }

    /**
     * Display the specified resource.
     */
//    public function show(string $id)
//    {
//        return view('basic.registration');
//    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $unattachedCourses = Course::whereDoesntHave('users', function ($query) use ($id) {
            $query->where('users.id', $id);
        })->get();

        return view('admin.edit_user', ['user' => User::find($id), 'unattachedCourses' => $unattachedCourses]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(EditUserRequest $request, string $id)
    {
        $user = User::find($id);
        $user->update($request->input());

        if ($request->has('attachCourses')) {
            foreach ($request->input('attachCourses') as $course) {
                $user->courses()->attach($course, ['is_confirmed' => true]);
            }
        }

        if ($request->has('detachCourses')) {
            foreach ($request->input('detachCourses') as $course) {
                $user->courses()->detach($course);
            }
        }
        return redirect()->route('admin.index')->with('success', 'Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
//        if ($tag->posts->count()) {
//            return redirect()->route('tags.index')->with('error', 'Ошибка! У тегов есть записи');
//        }
        $user->delete();
        return redirect()->route('admin.index')->with('success', 'Пользователь удален');
    }
}
