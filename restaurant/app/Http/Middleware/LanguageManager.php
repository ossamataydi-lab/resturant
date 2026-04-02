<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Setting;

class LanguageManager
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if this is an admin route
        $isAdmin = $request->is('admin/*') || $request->routeIs('admin.*');

        if ($isAdmin) {
            // Get admin locale from session, or set default
            $locale = session('admin_locale');

            if (!$locale) {
                $locale = 'fr'; // Default admin language
                session(['admin_locale' => $locale]);
            }
        } else {
            // Get client locale from session
            $locale = session('locale');

            if (!$locale) {
                // Try to get from database
                $settings = Setting::first();
                $locale = $settings ? $settings->locale : 'fr';
                session(['locale' => $locale]);
            }
        }

        // Validate locale
        if (!in_array($locale, ['fr', 'en', 'ar'])) {
            $locale = 'fr';
            if ($isAdmin) {
                session(['admin_locale' => $locale]);
            } else {
                session(['locale' => $locale]);
            }
        }

        // Set the application locale
        App::setLocale($locale);

        // Store last visited area for language switching
        session(['last_visited_area' => $isAdmin ? 'admin' : 'client']);

        return $next($request);
    }
}
