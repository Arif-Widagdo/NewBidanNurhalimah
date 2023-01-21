<?php

namespace Database\Factories;

use App\Models\SiteInformation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            'name' => fake()->unique()->colorName(),
            'slug' => fake()->slug(),
        ];
    }
}
