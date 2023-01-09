<?php

namespace Database\Seeders;

use App\Models\BirthControl;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BirthControlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BirthControl::create([
            'id' => fake()->uuid(),
            'name' => 'MOW/Tubektomi',
            'slug' => 'mow-tubektomi',
        ]);
        BirthControl::create([
            'id' => fake()->uuid(),
            'name' => 'MOP/Vasektomi',
            'slug' => 'mop-vasektomi',
        ]);
        BirthControl::create([
            'id' => fake()->uuid(),
            'name' => 'AKDR/IUD',
            'slug' => 'akdr-iud',
        ]);
        BirthControl::create([
            'id' => fake()->uuid(),
            'name' => 'Suntik',
            'slug' => 'suntik',
        ]);
        BirthControl::create([
            'id' => fake()->uuid(),
            'name' => 'Pill',
            'slug' => 'pill',
        ]);
        BirthControl::create([
            'id' => fake()->uuid(),
            'name' => 'Kondom',
            'slug' => 'kondom',
        ]);
        BirthControl::create([
            'id' => fake()->uuid(),
            'name' => 'Susuk KB',
            'slug' => 'susuk-kb',
        ]);
        BirthControl::create([
            'id' => fake()->uuid(),
            'name' => 'Lainnya/Intravag',
            'slug' => 'lainnya-intravag',
        ]);
        BirthControl::create([
            'id' => fake()->uuid(),
            'name' => 'Cara Tradisional',
            'slug' => 'cara-tradisional',
        ]);
    }
}
