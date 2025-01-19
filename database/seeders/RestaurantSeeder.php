<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    public function run()
    {
        Restaurant::create([
            'name' => 'Italian Bistro',
            'image' => 'assets/italian_bistro.jpg',
            'description' => 'A cozy place for authentic Italian dishes.',
            'address' => '123 Pasta Street, Roma',
        ]);

        Restaurant::create([
            'name' => 'Burger Heaven',
            'image' => 'assets/burger_heaven.jpg',
            'description' => 'The best burgers in town, made fresh daily.',
            'address' => '456 Burger Lane, Gotham',
        ]);
    }
}
