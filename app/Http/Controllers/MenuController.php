<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::paginate(3); // Display 3 menus on the homepage
        return view('home', compact('menus'));
    }

    public function menuPage(Request $request)
    {
        $query = Menu::query();

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('sort') && in_array($request->sort, ['asc', 'desc'])) {
            $query->orderBy('price', $request->sort);
        }

        $menus = $query->paginate(9); // Paginate menus
        return view('menu.index', compact('menus'));
    }

    public function menuDetail($id)
    {
        $menu = Menu::find($id);
        return view('menu.detail', compact('menu'));
    }
}
