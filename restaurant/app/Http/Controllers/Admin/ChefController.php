<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chef;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChefController extends Controller
{
    public function index()
    {
        $chef = Chef::first();
        $currentLocale = session('admin_locale', 'fr');
        return view('admin.chef.index', compact('chef', 'currentLocale'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'philosophy' => 'nullable|string'
        ]);

        $data = $request->only(['name', 'description', 'philosophy']);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('chefs', 'public');
        }

        Chef::create($data);

        return redirect()->route('admin.chef.index')->with('success', 'Chef ajouté avec succès !');
    }

    public function update(Request $request, Chef $chef)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'image_path' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'philosophy' => 'nullable|string'
        ]);

        $data = $request->only(['name', 'description', 'philosophy', 'image_path']);

        if ($request->hasFile('image')) {

            if ($chef->image_path) {
                Storage::delete('public/' . $chef->image_path);
            }
            $data['image_path'] = $request->file('image')->store('chefs', 'public');
        }

        $chef->update($data);

        return back()->with('success', 'Infos du Chef mises à jour !');
    }

    public function destroy(Chef $chef)
    {
        Storage::delete('public/' . $chef->image_path);
        $chef->delete();
        return back()->with('success', 'Image supprimée.');
    }
}
