<?php

namespace Database\Seeders;

use App\Models\Graduated;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GraduatedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Graduated::create([
            'id' => fake()->uuid(),
            'name' => 'Tidak Sekolah',
            'slug' => 'tidak-sekolah',
        ]);
        Graduated::create([
            'id' => fake()->uuid(),
            'name' => 'Tidak Tamat SD/MI',
            'slug' => 'tidak-tamat-sd-mi',
        ]);
        Graduated::create([
            'id' => fake()->uuid(),
            'name' => 'Tamat SD/MI (Sekolah Dasar)',
            'slug' => 'tamat-sd-mi',
        ]);
        Graduated::create([
            'id' => fake()->uuid(),
            'name' => 'Tamat SLTP/MTSN (Sekolah Lanjutan Tingkat Pertama)',
            'slug' => 'tamat-sltp-mtsn',
        ]);
        Graduated::create([
            'id' => fake()->uuid(),
            'name' => 'Tamat SLTA/MA (Sekolah Lanjutan Tingkat Atas)',
            'slug' => 'tamat-slta-ma',
        ]);
        Graduated::create([
            'id' => fake()->uuid(),
            'name' => 'Tamat PT (Perguruan Tinggi)',
            'slug' => 'tamat-pt',
        ]);
    }
}
