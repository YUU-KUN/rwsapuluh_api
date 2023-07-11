<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mission;

class MissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 6; $i++) { 
            Mission::create([
                'mission' => 'Membangun Kualitas Sumber Daya Manusia di bidang Pendidikan, Kesehatan dan Memantapkan Kesalehan Sosial Berlandaskan Iman dan Taqwa;.',
            ]);
        }
    }
}
