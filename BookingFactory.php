<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'check_in' => $this->faker->dateTime(),
            'check_out' => $this->faker->dateTime(),
            'start_at' => $this->faker->time(),
            'end_at' => $this->faker->time(),
        ];
    }
}
