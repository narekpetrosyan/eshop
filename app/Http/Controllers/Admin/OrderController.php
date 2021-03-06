<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('status',0)->get();
        return view('auth.orders.index',compact('orders'));
    }

    public function show($id)
    {
        $order = Order::find($id);
        return view('auth.orders.show',compact('order'));
    }
}
