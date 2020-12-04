<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function basket()
    {
        $orderId = session('orderId');
        if (empty($orderId)) {
            $order = Order::create()->id;
        } else {
            $order = Order::find($orderId);
        }
        return view('basket', compact('order'));
    }

    public function place()
    {
        $orderId = session('orderId');
        if (empty($orderId)) {
            return redirect()->route('index');
        }
        $order = Order::find($orderId);
        return view('order', compact('order'));
    }

    public function add($productId)
    {
        $orderId = session('orderId');
        if (empty($orderId)) {
            $order = Order::create()->id;
            session(['orderId' => $order]);
        } else {
            $order = Order::find($orderId);
        }

        if ($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        } else {
            $order->products()->attach($productId);
        }

        if(auth()->check()){
            $order->user_id = auth()->id();
            $order->save();
        }

        $product = Product::find($productId);

        session()->flash('success', 'Product '. $product->name .' added to basket.');

        return redirect()->route('basket');
    }

    public function remove($productId)
    {
        $orderId = session('orderId');
        if (empty($orderId)) {
            return redirect()->route('basket');
        }
        $order = Order::find($orderId);

        if ($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            if ($pivotRow->count < 2) {
                $order->products()->detach($productId);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }

        return redirect()->route('basket');
    }

    public function confirm(Request $request)
    {
        $orderId = session('orderId');
        if (empty($orderId)) {
            return redirect()->route('index');
        }
        $order = Order::find($orderId);
        $success = $order->saveOrder($request->name, $request->phone);

        if ($success) {
            session()->flash('success', 'Your order accepted.');
        } else {
            session()->flash('warning', 'Error while accepting your order.');
        }

        return redirect()->route('index');
    }
}
