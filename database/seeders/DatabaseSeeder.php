<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create users before creating jobs // Create 10 users

        // Ensure categories and job types exist if they are required
        // \App\Models\Category::factory(5)->create(); // Create categories
        // \App\Models\JobType::factory(5)->create(); // Create job types
        
        // Now create jobs
        \App\Models\Job::factory(20)->create(); // Create jobs
        
    }
}
