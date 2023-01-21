<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Couple;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\AcceptorSeeder;
use Database\Seeders\PositionSeeder;
use Database\Seeders\GraduatedSeeder;
use Database\Seeders\BirthControlSeeder;
use Database\Seeders\SiteInformationSeeder;

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
        Couple::factory(10)->create();
        // --------------------------------
        // CREATE BIRTH CONTROLS 
        // --------------------------------
        $this->call(BirthControlSeeder::class);
        // --------------------------------
        // CREATE ACCEPTORS 
        // --------------------------------
        $this->call(AcceptorSeeder::class);
        // --------------------------------
        // CREATE SITE INFORMATION 
        // --------------------------------
        $this->call(SiteInformationSeeder::class);
        // --------------------------------
        // CREATE CATEGORY & FAQ
        // --------------------------------
        \App\Models\Category::factory(10)->create();
        \App\Models\FAQ::factory(10)->create();
    }
}
