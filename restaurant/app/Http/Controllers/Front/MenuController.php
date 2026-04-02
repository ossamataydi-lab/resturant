<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {

        $categories = Category::with('products')->get();

        return view('Client_Side.menu', compact('categories'));
    }
}
