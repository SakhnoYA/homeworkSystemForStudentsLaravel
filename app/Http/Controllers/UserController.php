<?php

namespace App\Http\Controllers;

use App\Actions\AttachCoursesAction;
use App\Actions\DetachCoursesAction;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $page = $request->input('page', 1);

        $cacheKey = "cached_users_{$request->input('type')}_page_$page";

        if (Cache::has($cacheKey)) {
            $users = Cache::get($cacheKey);
        } else {
            $users = User::when($request->has('type'), function ($query) use ($request) {
                $query->where('user_type_id', $request->input('type'));
            })
                ->where('user_type_id', '!=', 1)
                ->with('user_type')
                ->orderBy('created_at')
                ->paginate(config('constants.options.paginate_number'));

            Cache::put($cacheKey, $users);
        }

        return view('admin.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create_user', ['courses' => Course::all()]);
    }

    public function register()
    {
        return view('basic.registration');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegistrationRequest $request, AttachCoursesAction $attachCoursesAction)
    {
        $user = User::create($request->except('_token') + ['ip' => $request->ip()]);

        $attachCoursesAction($request, $user, true);

        if (!$request->get('is_confirmed')) {
            session()->flash('success', 'Заявка на регистрацию отправлена');
            return redirect()->route('login');
        }
        session()->flash('success', 'Пользователь создан');
        return redirect()->route('admin.index');
    }

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
    public function update(
        EditUserRequest $request,
        AttachCoursesAction $attachCoursesAction,
        DetachCoursesAction $detachCoursesAction,
        string $id
    ) {
        $user = User::find($id);
        $user->update($request->input());

        $attachCoursesAction($request, $user, true);
        $detachCoursesAction($request, $user);

        return redirect()->route('admin.index')->with('success', 'Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        return redirect()->route('admin.index')->with('success', 'Пользователь удален');
    }
}
