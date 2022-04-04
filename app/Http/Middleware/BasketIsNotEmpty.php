<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Order;

class BasketIsNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $order_id = session('order_id');
        if ($order_id != null)
        {
            $order = Order::findOrFail($order_id);
            if ($order->items->count() > 0)
                return $next($request);
        }

        session()->flash('warning', 'Ваша корзина пуста');
        return redirect()->route('catalog');
    }
}
