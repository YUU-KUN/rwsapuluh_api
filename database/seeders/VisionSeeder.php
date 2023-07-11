<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vision;

class VisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vision::create([
            'vision' => 'Terwujudnya Masyarakat Rukun Warga (RW) 17 Kelurahan Madyopuro yang Kreatif, Mandiri, Berdaya saing dan Bermartabat.',
        ]);
    }
}
