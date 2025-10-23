<?php

namespace Database\Factories;

use App\Models\CleaningJob;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount_owed' => $this->faker->randomFloat(2, 5, 30),
            'amount_paid' => $this->faker->randomFloat(2, 5, 30),
            'satisfied_at' => Carbon::now()->addMonth(),
            'due_at' => Carbon::now()->addMonth()
        ];
    }

    public function forCleaningJob(CleaningJob $cleaningJob)
    {
        return $this->state(fn(array $attributes) => [
            'cleaning_job_id' => $cleaningJob->id,
        ]);
    }
}
