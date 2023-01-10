<?php

namespace Database\Factories;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => fake()->uuid(),
            'name' => fake()->name('F'),
            'phoneNumber' => fake()->phoneNumber(),
            'place_brithday' => fake()->country(),
            'date_brithday' => Carbon::today()->subDays(rand(12250, 24500)),
            'gender' => 'F',
            'marital_status' => fake()->randomElement(['single', 'married', 'divorced', 'dead_divorced']),
            'address' => fake()->address(),
        ];
    }
}
