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

    public function create()
    {
        $restaurants = Restaurant::all();
        return view('restaurant.create', compact('restaurants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|string|starts_with:assets/',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
        ]);

        Restaurant::create([
            'name' => $request->name,
            'image' => $request->image,
            'description' => $request->description,
            'address' => $request->address,
        ]);

        return redirect()->route('restaurant.index')->with('success', 'Restaurant added successfully.');
    }

    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();

        return redirect()->route('restaurant.index')->with('success', 'Restaurant deleted successfully.');
    }

}

