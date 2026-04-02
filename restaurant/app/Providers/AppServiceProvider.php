<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share the restaurant setting and current locale globally with all views
        View::composer('*', function ($view) {
            $settings = Setting::first();
            if (!$settings) {
                $settings = Setting::create([
                    'name' => 'Délice',
                    'logo' => null,
                    'description' => '',
                    'phone' => '',
                    'whatsapp' => '',
                    'address' => '',
                    'lat' => null,
                    'lng' => null,
                    'is_active' => true,
                    'prep_time' => 30,
                    'min_order' => 10,
                    'delivery_radius' => 5,
                    'opening_hours' => [],
                    'locale' => 'fr'
                ]);
            }

            // Determine if this is an admin request
            $request = request();
            $isAdmin = $request && ($request->is('admin/*') || $request->routeIs('admin.*'));

            if ($isAdmin) {
                // Get admin locale from session
                $currentLocale = session('admin_locale', 'fr');
            } else {
                // Get client locale from session or settings
                $currentLocale = session('locale', $settings->locale ?? 'fr');
            }

            // Validate locale
            if (!in_array($currentLocale, ['fr', 'en', 'ar'])) {
                $currentLocale = 'fr';
            }

            App::setLocale($currentLocale);

            $view->with('settings', $settings);
            $view->with('currentLocale', $currentLocale);
        });
    }
}
