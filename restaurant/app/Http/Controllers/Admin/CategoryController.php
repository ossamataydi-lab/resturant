<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $currentLocale = session('admin_locale', 'fr');
        return view('admin.categories.index', compact('categories', 'currentLocale'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|unique:categories|max:100',
        ]);


        Category::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie ajoutée avec succès!');
    }

    public function destroy($id)
    {
        // Find category by ID
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('admin.categories.index')->with('error', 'Catégorie non trouvée.');
        }

        // Check if category has products
        if ($category->products()->count() > 0) {
            return redirect()->route('admin.categories.index')->with('error', 'Impossible de supprimer cette catégorie car elle contient des produits. Veuillez dabord supprimer les produits.');
        }

        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Catégorie supprimée avec succès!');
    }
}
