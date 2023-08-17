<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userTypes = [
            ['name' => 'admin', 'readable_name' => 'Администратор', 'path' => 'users'],
            ['name' => 'student', 'readable_name' => 'Студент', 'path' => 'course'],
            ['name' => 'teacher', 'readable_name' => 'Преподаватель', 'path' => 'course']
        ];

        collect($userTypes)->each(fn($userTypes) => UserType::create($userTypes));
    }
}
