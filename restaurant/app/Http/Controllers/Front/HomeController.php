<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Chef;
use App\Models\Gallery;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->get();

        $featuredProducts = Product::latest()->take(6)->get();

        $galleries = Gallery::latest()->get();
        $chef = Chef::first();
        $setting = Setting::first();

        return view('Client_Side.accueil', compact(
            'categories',
            'featuredProducts',
            'galleries',
            'chef',
            'setting'
        ));
    }
}
