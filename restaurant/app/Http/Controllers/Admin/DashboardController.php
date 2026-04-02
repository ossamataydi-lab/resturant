<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Table;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'today_orders'       => Order::whereDate('created_at', now())->count(),
            'today_revenue'      => Order::whereDate('created_at', now())->where('status', 'delivered')->sum('total_price'),
            'total_users'        => User::count(),
            'total_products'     => Product::count(),
            'pending_orders'     => Order::where('status', 'pending')->count(),
            'delivered_orders'   => Order::where('status', 'delivered')->count(),
            'pending_reservations' => Reservation::where('status', 'pending')->count(),
        ];

        $recent_reservations = Reservation::latest()->take(5)->get();

        // Get all pending reservations for the admin to manage
        $pending_reservations = Reservation::where('status', 'pending')
            ->orderBy('reservation_time', 'asc')
            ->get();

        $popular_products = Product::withCount('orderItems')
            ->orderBy('order_items_count', 'desc')
            ->take(5)
            ->get();

        // Chart data: Orders for the last 7 days
        $ordersByDay = [];
        $orderCounts = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $ordersByDay[] = $date->format('D');
            $orderCounts[] = Order::whereDate('created_at', $date)->count();
        }

        // Ensure arrays are always defined with fallback values
        $ordersByDay = !empty($ordersByDay) ? $ordersByDay : ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
        $orderCounts = !empty($orderCounts) ? $orderCounts : [0, 0, 0, 0, 0, 0, 0];

        // Chart data: Popular products for doughnut chart
        $popularProductNames = $popular_products->isNotEmpty() ? $popular_products->pluck('name')->toArray() : ['Aucun plat'];
        $popularProductCounts = $popular_products->isNotEmpty() ? $popular_products->pluck('order_items_count')->toArray() : [1];

        // Get current locale from session (admin locale)
        $currentLocale = session('admin_locale', 'fr');

        return view('admin.dashboard', compact(
            'stats',
            'recent_reservations',
            'pending_reservations',
            'popular_products',
            'ordersByDay',
            'orderCounts',
            'popularProductNames',
            'popularProductCounts',
            'currentLocale'
        ));
    }

    public function login()
    {
        return view('admin.Register-Login.login');
    }

    public function register()
    {
        return view('admin.Register-Login.register');
    }


    // Register Logic
    public function postRegister(Request $request)
    {

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role'     => 'required',
        ]);


        $roleName = ($request->role === 'chef') ? 'Chef de Cuisine' : 'Administrateur';


        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => $roleName,
        ]);


        return redirect()->route('admin.Register-Login.login')->with('success', 'Compte créé avec succès !');
    }


    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            $role = $user->role;

            // role
            if ($role === 'Administrateur') {
                return redirect()->route('admin.dashboard');
            } elseif ($role === 'Chef de Cuisine') {
                return redirect()->route('admin.kitchen.index');
            }


            Auth::logout();
            return back()->withErrors(['email' => 'Role non reconnu: ' . $user->role]);
        }

        return back()->withErrors([
            'email' => 'Les identifiants ne correspondent pas.',
        ])->onlyInput('email');
    }

    // Logout Logic
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.Register-Login.login');
    }
}
