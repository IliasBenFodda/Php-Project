<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::with('items')->get();

        return view('admin.orders.index',compact('orders'));
    }

    public function show(Order $order){
        $order->load('items.product');

        return view('admin.orders.show',compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled'
        ]);
        $order->update($validated);

        return redirect()->route('admin.orders.index',$order)->with('success','Order status updated successfully');
    }
}
