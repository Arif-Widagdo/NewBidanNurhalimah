<?php

namespace Database\Seeders;

use App\Models\Work;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Work::create([
            'id' => fake()->uuid(),
            'name' => 'Petani',
            'slug' => 'petani',
        ]);
        Work::create([
            'id' => fake()->uuid(),
            'name' => 'Nelayan',
            'slug' => 'nelayan',
        ]);
        Work::create([
            'id' => fake()->uuid(),
            'name' => 'Pedagang',
            'slug' => 'pedagang',
        ]);
        Work::create([
            'id' => fake()->uuid(),
            'name' => 'PNS/TNI/POLRI',
            'slug' => 'pns-tni-polri',
        ]);
        Work::create([
            'id' => fake()->uuid(),
            'name' => 'Pegawai Swasta',
            'slug' => 'pegawai-swasta',
        ]);
        Work::create([
            'id' => fake()->uuid(),
            'name' => 'Wiraswasta',
            'slug' => 'wiraswasta',
        ]);
        Work::create([
            'id' => fake()->uuid(),
            'name' => 'Pensiunan',
            'slug' => 'pensiunan',
        ]);
        Work::create([
            'id' => fake()->uuid(),
            'name' => 'Pekerja Lepas',
            'slug' => 'pekerja-lepas',
        ]);
        Work::create([
            'id' => fake()->uuid(),
            'name' => 'Buruh',
            'slug' => 'buruh',
        ]);
        Work::create([
            'id' => fake()->uuid(),
            'name' => 'Tidak Bekerja',
            'slug' => 'tidak-bekerja',
        ]);
        Work::create([
            'id' => fake()->uuid(),
            'name' => 'Karyawan',
            'slug' => 'karyawan',
            'work_status' => 'male'
        ]);
        Work::create([
            'id' => fake()->uuid(),
            'name' => 'Karyawati',
            'slug' => 'karyawati',
            'work_status' => 'female'
        ]);
        Work::create([
            'id' => fake()->uuid(),
            'name' => 'Ibu Rumah Tangga',
            'slug' => 'ibu-rumah-tangga',
            'work_status' => 'female'
        ]);
    }
}
