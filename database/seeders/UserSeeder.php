<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 7345,
            'first_name' => 'рут',
            'last_name' => 'админ',
            'password' => 7345,
            'user_type_id' => 1,
            'is_confirmed' => true,
        ]);
        User::factory(20)->create();
    }
}
