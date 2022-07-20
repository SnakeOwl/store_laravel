<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Order;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    //ajax-method not yet
    public function add_item(Request $request, Item $item)
    {
        $order_id = session('order_id');

        if ( is_null($order_id) )
        {
            $order = Order::create();
            session(['order_id' => $order->id]);
        }
        else
        {
            $order = Order::find($order_id);
        }

        if($order->items->contains($item))
        {
            $pivot_row = $order->items()->where('item_id', $item->id)->first()->pivot;
            if ($item->amount > $pivot_row->amount)
            {
                $pivot_row->amount++;
                $pivot_row->update();
            }
            else
            {
                session()->flash('info', 'Больше нельзя добавить товар в корзину из-за отсутствия товара.');
                return redirect()->route('basket');
            }
        }
        else
        {
            $order->items()->attach($item);
        }

        session()->flash('info', 'Товар добавлен.');

        return redirect()->route('basket');
    }

    public function remove_item(Item $item)
    {
        $order_id = session('order_id');
        if ( !is_null($order_id) )
        {
            $order = Order::find($order_id);

            if($order->items->contains($item))
            {
                $pivot_row = $order->items()->where('item_id', $item->id)->first()->pivot;
                if($pivot_row->amount < 2)
                {
                    $order->items()->detach($item);
                }
                else
                {
                    $pivot_row->amount--;
                    $pivot_row->update();
                }
            }
        }

        session()->flash('info', 'Товар удален.');

        return redirect()->route('basket');
    }

    public function index()
    {
        $order_id = session('order_id');
        if ($order_id == false)
        {
            session()->flash('info', 'Ваша корзина пуста');

            return view('catalog.basket');
        }
        else
        {
            return view('catalog.basket', [
                'order' => Order::findOrFail($order_id)
            ]);
        }
    }
}
