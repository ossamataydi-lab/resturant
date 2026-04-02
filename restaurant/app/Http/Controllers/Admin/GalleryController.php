<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->get();
        $currentLocale = session('admin_locale', 'fr');
        return view('admin.gallery.index', compact('galleries', 'currentLocale'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:5120',
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('gallery', 'public');
        }

        Gallery::create($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Photo ajoutée à la galerie avec succès !');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image_path) {
            Storage::delete('public/' . $gallery->image_path);
        }
        $gallery->delete();

        return back()->with('success', 'Photo supprimée de la galerie.');
    }
}
