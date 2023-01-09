<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'id' => fake()->uuid(),
            'name' => 'Administrator',
            'slug' => 'administrator',
        ]);
        Role::create([
            'id' => fake()->uuid(),
            'name' => 'Patient',
            'slug' => 'patient',
        ]);
    }
}
