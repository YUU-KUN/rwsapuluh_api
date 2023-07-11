<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'rwsapuluhcipagalo',
            'role' => 'superadmin',
            'email' => 'rwsapuluhcipagalo@mail.com',
            'password' => Hash::make('rwsapuluhcipagalo'),
        ]);
    }
}
