<?php

namespace Database\Seeders;

use App\Models\SiteInformation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $site = SiteInformation::create([
            'id' => fake()->uuid(),
            'address' => 'Kp. Mulya Asih Rt 04/05 Desa Cimhai Kec. Klari Kab. Karawang',
            'telp' => '(62+) 8960 1909 107',
            'email' => 'bidannurhalimah334@gmail.com',
            'facebook' => 'https://www.facebook.com/',
            'twitter' => 'https://www.twitter.com/',
            'instagram' => 'https://www.instagram.com/',
            'linkedin' => 'https://www.linkedin.com/'
        ]);
    }
}
