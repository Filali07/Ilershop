<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => 0,
            'status' => 'pending',
        ]);

        $total = 0;
        foreach ($request->products as $item) {
            $product = Product::find($item['product_id']);
            $order->products()->attach($product->id, [
                'quantity' => $item['quantity'],
                'price_at_purchase' => $product->price,
            ]);
            $total += $product->price * $item['quantity'];
            $product->decrement('stock', $item['quantity']);
        }

        $order->update(['total' => $total]);
        return response()->json($order, 201);
    }

    public function index()
    {
        return Order::with('products')->where('user_id', auth()->id())->get();
    }
}