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
            ['name' => 'admin', 'readable_name' => 'Администратор'],
            ['name' => 'student', 'readable_name' => 'Студент'],
            ['name' => 'teacher', 'readable_name' => 'Преподаватель']
        ];

        collect($userTypes)->each(fn($userTypes) => UserType::create($userTypes));
    }
}
