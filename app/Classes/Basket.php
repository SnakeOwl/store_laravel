<?php
namespace App\Classes;

use App\Models\Order;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCreated;

class Basket
{
    protected $order;

    public function __construct($create_order = false)
    {
        $order_id = session('order_id');
        if ( is_null($order_id) && $create_order)
        {
            $this->order = Order::create();
            session(['order_id' => $this->order->id]);

            if (Auth::check())
            {
                $user = User::find(Auth::id());
                $user->orders()->attach($this->order);
            }
        }
        else
        {
            $this->order = Order::findOrFail($order_id);
        }
    }

    public function amount_available($update_amount = false)
    {
        foreach ($this->order->items as $item)
        {
            if ($item->amount < $this->get_pivot_row($item)->amount)
                return false;

            if ($update_amount)
            {
                $item->amount -= $this->get_pivot_row($item)->amount;
            }
        }

        if ($update_amount)
        {
            $this->order->items->map->save();
        }

        return true;
    }

    public function save_order($params)
    {
        if (!$this->amount_available(true))
            return false;

        $this->order->save_order($params);

        $email = Auth::check() ? Auth::user()->email: $params['email'];
        Mail::to($email)->send(new OrderCreated($this->get_order()));
    }

    public function get_order()
    {
        return $this->order;
    }

    protected function get_pivot_row($item)
    {
        return $this->order->items()->where('item_id', $item->id)->first()->pivot;
    }

    public function remove_item(Item $item)
    {
        if($this->order->items->contains($item))
        {
            $pivot_row = $this->get_pivot_row($item);
            if($pivot_row->amount < 2)
            {
                $this->order->items()->detach($item);
            }
            else
            {
                $pivot_row->amount--;
                $pivot_row->update();
            }
        }
    }

    public function add_item(Item $item)
    {
        if($this->order->items->contains($item))
        {
            $pivot_row = $this->get_pivot_row($item);
            if ($item->amount > $pivot_row->amount)
            {
                $pivot_row->amount++;
                $pivot_row->update();
            }
            else
                return "Больше нельзя добавить товар в корзину из-за его отсутствия";
        }
        else
        {
            $this->order->items()->attach($item);
        }

        return "Товар добавлен";
    }
}
