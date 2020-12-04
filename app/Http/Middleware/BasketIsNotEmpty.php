<?php

namespace App\Http\Middleware;

use App\Models\Order;
use Closure;
use Illuminate\Http\Request;

class BasketIsNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $orderId = session('orderId');
        if (!empty($orderId)){
            $order = Order::find($orderId);
            if ($order->products->count() == 0){
                session()->flash('warning',"Basket is empty.");
                return back();
            }
        }
        return $next($request);
    }
}
