<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%')
                  ->orWhere('price', 'like', '%' . $request->input('search') . '%');
        }

        $products = $query->get();

        return view('home', compact('products'));
    }
}
