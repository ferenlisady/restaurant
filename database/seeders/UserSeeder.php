<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Feren',
            'email' => 'feren@gmail.com',
            'password' => bcrypt('feren123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Lisady',
            'email' => 'lisady@gmail.com',
            'password' => bcrypt('lisady123'),
            'role' => 'resto',
        ]);
    }
}

