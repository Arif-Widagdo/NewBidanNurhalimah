<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::create([
            'id' => fake()->uuid(),
            'name' => 'Admin',
            'slug' => 'admin',
        ]);
        Position::create([
            'id' => fake()->uuid(),
            'name' => 'Bidan',
            'slug' => 'bidan',
        ]);
        Position::create([
            'id' => fake()->uuid(),
            'name' => 'Asisten',
            'slug' => 'asisten',
        ]);
    }
}
