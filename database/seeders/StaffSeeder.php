<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Staff;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // --------------------------------
        // CREATE STAFF ACCOUNT
        // --------------------------------
        $role_administrator = \App\Models\Role::whereSlug('administrator')->first();
        $admin = User::create([
            'id' => fake()->uuid(),
            'role_id' => $role_administrator->id,
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'status' => 'actived',
            'email_verified_at' => now(),
        ]);

        $midwife = User::create([
            'id' => fake()->uuid(),
            'role_id' => $role_administrator->id,
            'username' => fake()->userName(),
            'email' => 'midwife@example.com',
            'password' => Hash::make('password'),
            'status' => 'actived',
            'email_verified_at' => now(),
        ]);
        $midwife2 = User::create([
            'id' => fake()->uuid(),
            'role_id' => $role_administrator->id,
            'username' => fake()->userName(),
            'email' => 'midwife2@example.com',
            'password' => Hash::make('password'),
            'status' => 'actived',
            'email_verified_at' => now(),
        ]);
        $midwife3 = User::create([
            'id' => fake()->uuid(),
            'role_id' => $role_administrator->id,
            'username' => fake()->userName(),
            'email' => 'midwife3@example.com',
            'password' => Hash::make('password'),
            'status' => 'actived',
            'email_verified_at' => now(),
        ]);

        // --------------------------------
        // CREATE STAFF
        // --------------------------------
        $position_admin = \App\Models\Position::whereSlug('admin')->first();
        Staff::create([
            'id' => fake()->uuid(),
            'user_id' => $admin->id,
            'position_id' => $position_admin->id,
            'name' => fake()->name(),
            'phoneNumber' => fake()->phoneNumber(),
            'place_brithday' => fake()->country(),
            'date_brithday' => Carbon::today()->subDays(rand(0, 10950)),
            'gender' => fake()->randomElement(['F', 'M']),
            'address' => fake()->address(),
        ]);

        $position_midwife = \App\Models\Position::whereSlug('bidan')->first();
        Staff::create([
            'id' => fake()->uuid(),
            'user_id' => $midwife->id,
            'position_id' => $position_midwife->id,
            'name' => fake()->name('F'),
            'phoneNumber' => fake()->phoneNumber(),
            'place_brithday' => fake()->country(),
            'date_brithday' => Carbon::today()->subDays(rand(0, 10950)),
            'gender' => 'F',
            'address' => fake()->address(),
        ]);
        Staff::create([
            'id' => fake()->uuid(),
            'user_id' => $midwife2->id,
            'position_id' => $position_midwife->id,
            'name' => fake()->name('F'),
            'phoneNumber' => fake()->phoneNumber(),
            'place_brithday' => fake()->country(),
            'date_brithday' => Carbon::today()->subDays(rand(0, 10950)),
            'gender' => 'F',
            'address' => fake()->address(),
        ]);
        Staff::create([
            'id' => fake()->uuid(),
            'user_id' => $midwife3->id,
            'position_id' => $position_midwife->id,
            'name' => fake()->name('M'),
            'phoneNumber' => fake()->phoneNumber(),
            'place_brithday' => fake()->country(),
            'date_brithday' => Carbon::today()->subDays(rand(0, 10950)),
            'gender' => 'M',
            'address' => fake()->address(),
        ]);
        Staff::create([
            'id' => fake()->uuid(),
            'position_id' => $position_midwife->id,
            'name' => fake()->name('F'),
            'phoneNumber' => fake()->phoneNumber(),
            'place_brithday' => fake()->country(),
            'date_brithday' => Carbon::today()->subDays(rand(0, 10950)),
            'gender' => 'F',
            'address' => fake()->address(),
        ]);


        $position_asistant = \App\Models\Position::whereSlug('asisten')->first();
        \App\Models\Staff::factory()->create([
            'id' => fake()->uuid(),
            'position_id' => $position_asistant->id,
            'name' => fake()->name(),
            'phoneNumber' => fake()->phoneNumber(),
            'place_brithday' => fake()->country(),
            'date_brithday' => Carbon::today()->subDays(rand(0, 10950)),
            'gender' => fake()->randomElement(['F', 'M']),
            'address' => fake()->address(),
        ]);
    }
}
