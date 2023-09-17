<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'System Administrator',
            'email' => 'system@test.com',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", //password
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Admin Staff',
            'email' => 'staff@test.com',
            'password' => '$2a$10$CXzeriPxlwUvN/Y8HpWKEeQvYWy2LkRkUZuscHAD4ixshXcmmLQuG', //password2
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        \App\Models\Task::factory()->create([
            'task_title' => 'Sample Task 1',
            'task_description' => 'Sample 1 Description',
            'status' => "active",
            "user_id" => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        \App\Models\Task::factory()->create([
            'task_title' => 'Sample Task 2',
            'task_description' => 'Sample 2 Description',
            'status' => "active",
            "user_id" => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        \App\Models\Task::factory()->create([
            'task_title' => 'Sample Task 3',
            'task_description' => 'Sample 3 Description',
            'status' => "active",
            "user_id" => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
