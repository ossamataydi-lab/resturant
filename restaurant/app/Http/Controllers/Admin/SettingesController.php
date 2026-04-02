<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Artisan;

class SettingesController extends Controller
{
public function index()
    {
        $settings = Setting::first();
        $currentLocale = session('admin_locale', 'fr');
        return view('admin.settinges.index', compact('settings', 'currentLocale'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'is_active' => 'boolean',
            'min_order' => 'numeric|min:0',
            'opening_hours' => 'array',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'email' => 'nullable|string',
            'instagram' => 'nullable|string',
            'whatsapp' => 'nullable|string',
            'description' => 'nullable|string',
            'adresse' => 'nullable|string',
            'signe_price' => 'nullable|string',
            'address' => 'nullable|string',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
        ]);
        $settings = Setting::firstOrCreate(['id' => 1]);
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('settings/logos', 'public');
        }

        $settings->update($validated);
        return back()->with('success', 'success update settings');
    }
}
