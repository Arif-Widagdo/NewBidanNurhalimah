<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\PositionSeeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\GraduatedSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // --------------------------------
        // CREATE ROLES
        // --------------------------------
        $this->call(RoleSeeder::class);

        // --------------------------------
        // CREATE POSITIONS
        // --------------------------------
        $this->call(PositionSeeder::class);
        // --------------------------------
        // CREATE GRADUATEDS
        // --------------------------------
        $this->call(GraduatedSeeder::class);
        // --------------------------------
        // CREATE WORK
        // --------------------------------
        $this->call(WorkSeeder::class);
        // --------------------------------
        // CREATE STAFF
        // --------------------------------
        $this->call(StaffSeeder::class);
        // --------------------------------
        // CREATE PATIENT 
        // --------------------------------
        $this->call(PatientSeeder::class);
    }
}
