<?php

namespace Database\Seeders;

use App\Models\CleaningJob;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CleaningJobsNextWeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CleaningJob::factory()
            ->count(10)
            ->dueWithinOneWeek()
            ->create();
    }
}
