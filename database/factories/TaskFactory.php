<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'task_title' => fake()->title(),
            'task_description' => fake()->sentence(),
            'user_id' => 1,
            'maintask_id' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
