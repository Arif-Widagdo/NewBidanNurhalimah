<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\PositionSeeder;
use Database\Seeders\GraduatedSeeder;
use Database\Seeders\BirthControlSeeder;

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
        // CREATE WORKS
        // --------------------------------
        $this->call(WorkSeeder::class);
        // --------------------------------
        // CREATE STAFFS
        // --------------------------------
        $this->call(StaffSeeder::class);
        // --------------------------------
        // CREATE PATIENTS 
        // --------------------------------
        $this->call(PatientSeeder::class);
        // --------------------------------
        // CREATE BIRTH CONTROLS 
        // --------------------------------
        $this->call(BirthControlSeeder::class);
    }
}
