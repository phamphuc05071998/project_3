<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class OrderController extends Controller
{
    public function myOrders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();
        return view('orders.index', compact('orders'));
    }

    public function employeeOrders()
    {
        $orders = Order::all();
        return view('orders.employeeOrders', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('orderItems.product');
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|max:255',
        ]);

        $order->update($request->only('status'));

        if ($request->status === 'confirmed') {
            $this->applyLoyaltyPoints($order);
        }

        return redirect()->route('orders.employeeOrders')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.employeeOrders')->with('success', 'Order deleted successfully.');
    }

    private function applyLoyaltyPoints(Order $order)
    {
        $user = $order->user;
        $currentDate = now();

        foreach ($order->orderItems as $orderItem) {
            $product = $orderItem->product;
            $programs = $product->programs()->where('start_date', '<=', $currentDate)
                                            ->where('end_date', '>=', $currentDate)
                                            ->get();
            // dd($programs[0]->points);
            foreach ($programs as $program) {
                $user->points += $program->points * $orderItem->quantity;
            }
        }

        $user->save();
    }
}
