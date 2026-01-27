<?php

namespace Database\Factories;

use App\Models\Quote;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quote>
 */
class QuoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Quote::class;
    public function definition(): array
    {
        return [
            'estimate' => $this->faker->randomFloat(2, 5, 30),
            'house' => $this->faker->buildingNumber(),
            'street' => $this->faker->streetName(),
            'area' => $this->faker->city(),
            'phone' => $this->faker->phoneNumber(),
            'cleaning_frequency_weeks' => $this->faker->randomElement([4, 4, 4, 8]),
        ];
    }
}
