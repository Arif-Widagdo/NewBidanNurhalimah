<?php

namespace Database\Factories;

use App\Models\SiteInformation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FAQ>
 */
class FAQFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $site = SiteInformation::latest()->first();
        return [
            'id' => fake()->uuid(),
            'site_id' => $site->id,
            'title' => fake()->unique()->sentence(mt_rand(4, 5)),
            'description' => fake()->paragraph(),
        ];
    }
}
