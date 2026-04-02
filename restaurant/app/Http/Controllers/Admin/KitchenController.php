<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class KitchenController extends Controller
{
    public function index()
    {

        $allOrders = Order::with('orderItems.product')
            ->whereIn('status', ['pending', 'preparing', 'ready'])
            ->orderBy('created_at', 'asc')
            ->get();
        $orders = $allOrders->where('status','pending');
        $preparingOrders = $allOrders->where('status','preparing');
        $readyOrders = $allOrders->where('status','ready');

        return view('admin.kitchens.index', compact('orders','preparingOrders','readyOrders'));
    }


    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return back()->with('success', 'Statut mis à jour !');
    }
}
