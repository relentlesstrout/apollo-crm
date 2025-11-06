<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Customer::class;
    public function definition(): array
    {

        return [
            'house' => $this->faker->buildingNumber(),
            'street' => $this->faker->streetName(),
            'area' => $this->faker->city(),
            'phone' => $this->faker->phoneNumber(),
            'cleaning_frequency_weeks' => $this->faker->randomElement([4, 4, 4, 8]),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
