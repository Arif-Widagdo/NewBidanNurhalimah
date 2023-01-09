<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Couple;
use App\Models\Patient;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_patient = \App\Models\Role::whereSlug('patient')->first();
        $user = User::create([
            'id' => fake()->uuid(),
            'role_id' => $role_patient->id,
            'username' => fake()->userName(),
            'email' => 'patient@example.com',
            'password' => Hash::make('password'),
            'status' => 'actived',
            'email_verified_at' => now(),
        ]);

        $patient = Patient::create([
            'id' => fake()->uuid(),
            'user_id' => $user->id,
            'name' => fake()->name('F'),
            'phoneNumber' => fake()->phoneNumber(),
            'place_brithday' => fake()->country(),
            'date_brithday' => Carbon::today()->subDays(rand(0, 10950)),
            'gender' => 'F',
            'address' => fake()->address(),
        ]);

        Couple::create([
            'id' => fake()->uuid(),
            'patient_id' => $patient->id,
            'name' => fake()->name('M'),
            'phoneNumber' => fake()->phoneNumber(),
            'place_brithday' => fake()->country(),
            'date_brithday' => Carbon::today()->subDays(rand(0, 10950)),
            'gender' => 'M',
            'address' => fake()->address(),
        ]);
    }
}
