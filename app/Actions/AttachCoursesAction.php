<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Http\Request;

class AttachCoursesAction
{
    public function __invoke(Request $request, User $user, bool $is_confirmed = false): void
    {
        if ($request->has('attachCourses')) {
            foreach ($request->input('attachCourses') as $course) {
                $user->courses()->attach($course, ['is_confirmed' => $is_confirmed]);
            }
        }
    }
}
