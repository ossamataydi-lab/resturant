<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Setting;

class LanguageController extends Controller
{
    /**
     * Switch the application language
     */
    public function switch(Request $request, $locale)
    {
        // Validate the locale
        if (!in_array($locale, ['fr', 'en', 'ar'])) {
            $locale = 'fr';
        }

        // Get the intended destination (where to redirect back)
        $redirectTo = $request->query('redirect', $request->header('referer'));

        // Determine if this is an admin route by checking:
        // 1. The redirect URL contains '/admin/'
        // 2. Or the previous URL session indicates admin
        $isAdmin = false;

        if ($redirectTo && str_contains($redirectTo, '/admin/')) {
            $isAdmin = true;
        } elseif (session('last_visited_area') === 'admin') {
            $isAdmin = true;
        } elseif ($request->is('admin/*')) {
            $isAdmin = true;
        }

        if ($isAdmin) {
            // Store admin locale separately in session
            session(['admin_locale' => $locale, 'last_visited_area' => 'admin']);
        } else {
            // Store client locale in session
            session(['locale' => $locale, 'last_visited_area' => 'client']);
        }

        // Set the application locale
        App::setLocale($locale);

        // Redirect back to the previous page or the redirect parameter
        if ($redirectTo && !str_contains($redirectTo, '/language/')) {
            return redirect($redirectTo);
        }

        return redirect()->back();
    }

    /**
     * Get the current locale
     */
    public function getLocale()
    {
        return response()->json([
            'locale' => app()->getLocale(),
        ]);
    }
}
