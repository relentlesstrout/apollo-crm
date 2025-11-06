<?php

namespace Database\Factories;

use App\Models\CleaningJob;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CleaningJob>
 */
class CleaningJobFactory extends Factory
{
    protected $model = CleaningJob::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'price' => $this->faker->randomFloat(2, 5, 30),
            'scheduled_for' => Carbon::now()->addDays($this->faker->numberBetween(1, 28))->format('Y-m-d'),
            'status' => $this->faker->randomElement(['scheduled']),
            'notes' => $this->faker->text(),
        ];
    }

    public function forCustomer(Customer $customer): static
    {
        return $this->state(fn (array $attributes) => [
            'customer_id' => $customer->id,
        ]);
    }

    public function markCompleted(): static
    {
        return $this->state(fn (array $attributes) => [
            'scheduled_for' => Carbon::now()->subMonths($this->faker->numberBetween(1, 12))->format('Y-m-d'),
            'completed_at' => Carbon::now(),
            'status' => 'completed',
        ]);
    }

    public function dueWithinOneWeek(): static
    {
        return $this->state(fn (array $attributes) => [
            'scheduled_for' => Carbon::now()->addDays(7)->toDateString(),            ]);
    }
}
