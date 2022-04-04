<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    //ajax-method not yet
    public function add_item(Request $request, $id)
    {
        $item = Item::findOrFail($id);

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

        if($order->items->contains($id))
        {
            $pivot_row = $order->items()->where('item_id', $id)->first()->pivot;
            $pivot_row->amount++;
            $pivot_row->update();
        }
        else
        {
            $order->items()->attach($id);
        }

        if (Auth::check())
        {
            $order->user_id = Auth::id();
            $order->save();
        }

        session()->flash('info', 'Товар добавлен.');

        return redirect()->route('basket');
    }

    public function remove_item($id)
    {
        $order_id = session('order_id');
        if ( !is_null($order_id) )
        {
            $order = Order::find($order_id);

            if($order->items->contains($id))
            {
                $pivot_row = $order->items()->where('item_id', $id)->first()->pivot;
                if($pivot_row->amount < 2)
                {
                    $order->items()->detach($id);
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
            return view('catalog.basket', [
                'message' => "Ваша корзина пуста"
            ]);
        }
        else
        {
            return view('catalog.basket', [
                'order' => Order::findOrFail($order_id)
            ]);
        }
    }
}
