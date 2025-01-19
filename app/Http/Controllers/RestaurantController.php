<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    
    public function restaurantPage(Request $request)
    {
        $restaurants = Restaurant::when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        })->paginate(10);
        return view('restaurant.index', compact('restaurants'));
    }

    public function restaurantDetail($id)
    {
        $restaurant = Restaurant::with('menus')->find($id);
        return view('restaurant.detail', compact('restaurant'));
    }

    public function index(Request $request)
    {
        $query = Restaurant::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $restaurants = $query->paginate(9); 

        return view('restaurant.index', compact('restaurants'));
    }
}

