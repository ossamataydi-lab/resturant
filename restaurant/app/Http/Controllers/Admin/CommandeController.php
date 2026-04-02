<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        $query = Order::with(['user', 'orderItems.product']);

        if ($status) {
            $query->where('status', $status);
        }

        $orders = $query->latest()->get();

        $counts = [
            'all' => Order::count(),
            'pending' => Order::where('status', 'pending')->count(),
            'preparing' => Order::where('status', 'preparing')->count(),
            'ready' => Order::where('status', 'ready')->count(),
            'completed' => Order::where('status', 'completed')->count(),
        ];

        $settings = Setting::first();
        $currentLocale = session('admin_locale', 'fr');

        return view('admin.commendes.index', compact('orders', 'counts', 'settings', 'status', 'currentLocale'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return back()->with('success', 'Statut de la commande mis à jour avec succès.');
    }

    public function markDelivered($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'completed';
        $order->save();

        return back()->with('success', 'Commande marquée comme livrée.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return back()->with('success', 'Commande supprimée avec succès.');
    }
}
