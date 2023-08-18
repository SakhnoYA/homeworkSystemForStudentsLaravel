<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Http\Request;

class DetachCoursesAction
{
    public function __invoke(Request $request, User $user): void
    {
        if ($request->has('detachCourses')) {
            foreach ($request->input('detachCourses') as $course) {
                $user->courses()->detach($course);
            }
        }
    }
}
