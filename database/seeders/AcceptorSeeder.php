<?php

namespace Database\Seeders;

use App\Models\Acceptor;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AcceptorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patients = \App\Models\Patient::all();
        $birthControls = \App\Models\BirthControl::all();

        foreach ($patients as $patient) {
            foreach ($birthControls as $birthControl) {
                Acceptor::create([
                    'id' => fake()->uuid(),
                    'attendance_date' => Carbon::today()->subDays(rand(0, 7)),
                    'patient_id' => $patient->id,
                    'birth_control_id' => $birthControl->id,
                    'menstrual_date' => Carbon::today()->subDays(rand(0, 14)),
                    'weight' => rand(60, 80),
                    'blood_pressure' => rand(100, 120) . '/' . rand(60, 80),
                    'description' => fake()->paragraph(),
                    'return_date' => Carbon::today()->addDays(5),
                ]);
            }
        }
    }
}
