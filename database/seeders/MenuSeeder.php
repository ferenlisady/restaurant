<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        Menu::create([
            'name' => 'Spaghetti Bolognese',
            'description' => 'A classic Italian pasta with rich meat sauce.',
            'image' => 'assets/spaghetti.jpg',
            'price' => 10.99,
            'restaurant_id' => '1',
        ]);

        Menu::create([
            'name' => 'Cheeseburger',
            'description' => 'Juicy beef patty with melted cheese and fresh toppings.',
            'image' => 'assets/cheeseburger.jpg',
            'price' => 7.99,
            'restaurant_id' => '2',
        ]);

        Menu::create([
            'name' => 'Caesar Salad',
            'description' => 'Crispy lettuce with Caesar dressing and croutons.',
            'image' => 'assets/caesar_salad.jpg',
            'price' => 5.99,
            'restaurant_id' => '1',
        ]);
    }
}

