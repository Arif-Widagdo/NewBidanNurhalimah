<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Couple>
 */
class CoupleFactory extends Factory
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
            'patient_id' => Patient::factory()->create()->id,
            'name' => fake()->name('M'),
            'phoneNumber' => fake()->phoneNumber(),
            'place_brithday' => fake()->country(),
            'date_brithday' => Carbon::today()->subDays(rand(13250, 24500)),
            'gender' => 'M',
            'address' => fake()->address(),
        ];
    }
}
