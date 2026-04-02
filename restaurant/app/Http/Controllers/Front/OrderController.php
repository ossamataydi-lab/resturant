<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Get product data for order modal (AJAX)
     */

    public function get(){
        $categories = \App\Models\Category::with('products')->get();
        return view('Client_Side.commande', compact('categories'));
    }

    public function getProduct(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        return response()->json([
            'success' => true,
            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image
            ]
        ]);
    }

    /**
     * Get cart data (AJAX) - returns cart items from session
     */
    public function getCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $cartItems = [];
        $total = 0;

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $itemTotal = $product->price * $item['quantity'];
                $total += $itemTotal;
                $cartItems[] = [
                    'id' => $productId,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image,
                    'quantity' => $item['quantity'],
                    'item_total' => $itemTotal
                ];
            }
        }

        return response()->json([
            'success' => true,
            'cart' => $cartItems,
            'total' => $total,
            'cart_count' => count($cart)
        ]);
    }

    /**
     * Add item to cart (AJAX)
     */
    public function addToCart(Request $request)
    {
        $productId = $request->product_id;
        $quantity = $request->quantity ?? 1;

        $product = Product::findOrFail($productId);

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'quantity' => $quantity
            ];
        }

        session()->put('cart', $cart);

        $cartCount = count($cart);
        $total = $this->calculateCartTotal($cart);

        return response()->json([
            'success' => true,
            'message' => $product->name . ' a été ajouté au panier!',
            'cart_count' => $cartCount,
            'total' => $total
        ]);
    }

    /**
     * Update item quantity in cart (AJAX)
     */
    public function updateCart(Request $request)
    {
        $productId = $request->product_id;
        $quantity = $request->quantity;

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            if ($quantity <= 0) {
                unset($cart[$productId]);
            } else {
                $cart[$productId]['quantity'] = $quantity;
            }
        }

        session()->put('cart', $cart);

        $cartCount = count($cart);
        $total = $this->calculateCartTotal($cart);

        return response()->json([
            'success' => true,
            'cart_count' => $cartCount,
            'total' => $total
        ]);
    }

    /**
     * Remove item from cart (AJAX)
     */
    public function removeFromCart(Request $request)
    {
        $productId = $request->product_id;

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }

        session()->put('cart', $cart);

        $cartCount = count($cart);
        $total = $this->calculateCartTotal($cart);

        return response()->json([
            'success' => true,
            'message' => 'Produit supprimé du panier',
            'cart_count' => $cartCount,
            'total' => $total
        ]);
    }

    /**
     * Clear cart (AJAX)
     */
    public function clearCart(Request $request)
    {
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Panier vidé',
            'cart_count' => 0,
            'total' => 0
        ]);
    }

    /**
     * Calculate cart total
     */
    private function calculateCartTotal($cart)
    {
        $total = 0;
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $total += $product->price * $item['quantity'];
            }
        }
        return $total;
    }

    /**
     * Place order directly from menu/accueil page
     * Order goes directly to kitchen and admin.commandes.index
     */
    public function placeOrder(Request $request)
    {
        // Debug: Log the incoming request
        \Log::info('Order request received:', $request->all());

        // Parse items - handle both JSON string and array
        $items = $request->input('items', []);

        if (is_string($items)) {
            $items = json_decode($items, true);
        }

        if ($request->has('product_id') && empty($items)) {
            $items = [[
                'product_id' => $request->product_id,
                'quantity' => $request->quantity ?? 1
            ]];
        }

        \Log::info('Parsed items:', ['items' => $items]);

        if (empty($items)) {
            return response()->json([
                'success' => false,
                'message' => 'Veuillez ajouter au moins un produit'
            ], 422);
        }

        // Validate form data
        $request->validate([
            'type' => 'required|in:delivery,takeaway',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $total = 0;
        $orderItemsData = [];

        foreach ($items as $index => $item) {
            if (!isset($item['product_id']) || !isset($item['quantity'])) {
                \Log::warning('Skipping invalid item:', $item);
                continue;
            }

            $product = Product::find($item['product_id']);

            if (!$product) {
                \Log::warning('Product not found:', ['product_id' => $item['product_id']]);
                continue;
            }

            $quantity = max(1, intval($item['quantity']));
            $itemPrice = $product->price;
            $total += $itemPrice * $quantity;

            $orderItemsData[] = [
                'product_id' => $product->id,
                'quantity'   => $quantity,
                'price'      => $itemPrice,
            ];
        }

        if (empty($orderItemsData)) {
            return response()->json([
                'success' => false,
                'message' => 'Aucun produit valide dans la commande'
            ], 422);
        }

        try {
            \Log::info('Creating order with data:', [
                'total_price' => $total,
                'type' => $request->type,
                'customer_name' => $request->name,
                'items_count' => count($orderItemsData)
            ]);

            $order = Order::create([
                'user_id'        => null,
                'total_price'    => $total,
                'status'         => Order::STATUS_PENDING,
                'type'           => $request->type,
                'customer_name'  => $request->name,
                'customer_phone' => $request->phone,
                'address'        => $request->address,
            ]);

            foreach ($orderItemsData as $itemData) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $itemData['product_id'],
                    'quantity'   => $itemData['quantity'],
                    'price'      => $itemData['price'],
                ]);
            }

            session()->forget('cart');

            \Log::info('Order created successfully:', ['order_id' => $order->id]);

            return response()->json([
                'success' => true,
                'message' => 'Commande passée avec succès! Elle sera préparée en cuisine.',
                'order_id' => $order->id
            ]);

        } catch (\Exception $e) {
            \Log::error('Order creation failed:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur technique: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show order success page
     */
    public function orderSuccess($orderId)
    {
        $order = Order::with('orderItems.product')->findOrFail($orderId);
        return view('Client_Side.order_success', compact('order'));
    }
}
