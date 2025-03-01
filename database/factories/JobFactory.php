<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle,
            'user_id' => Arr::random([1, 2, 3, 4]),// This creates a user if none exists
            'job_type_id' => rand(1, 5),
            'category_id' => rand(1, 5),
            'vacancy' => rand(1, 5),
            'location' => $this->faker->city,
            'description' => $this->faker->text,
            'experience' => rand(1, 10),
            'company_name' => $this->faker->company,
        ];
    }
}
