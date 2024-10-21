<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class CartController extends Controller
{
    public function add(Product $product)
    {
        $user = Auth::user();

        $cartItem = CartItem::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('home')->with('success', 'Product added to cart successfully!');
    }

    public function index()
    {
        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->get();

        return view('cart.index', compact('cartItems'));
    }

    public function remove(CartItem $cartItem)
    {
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully!');
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });

        $pointsUsed = 0;

        if ($request->has('use_points') && $user->points > 0) {
            $pointsUsed = min($user->points, $total);
            $total -= $pointsUsed;
            $user->points -= $pointsUsed;
            $user->save();
        }

        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'Pending',
            'total' => $total,
        ]);

        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ]);

            $cartItem->delete();
        }

        return redirect()->route('orders.show', $order->id)->with('success', 'Order created successfully! Points used: ' . $pointsUsed);
    }
}
