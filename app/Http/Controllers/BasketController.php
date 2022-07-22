<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Order;
use App\Models\User;
use App\Models\Storage;
use App\Classes\Basket;
use App\Http\Requests\CreateOrderRequest;

class BasketController extends Controller
{
    public function add_item(Item $item)
    {
        $msg = (new Basket(true))->add_item($item);
        session()->flash('info', $msg);

        return redirect()->route('basket');
    }

    public function remove_item(Item $item)
    {
        (new Basket())->remove_item($item);
        session()->flash('info', 'Товар удален');

        return redirect()->route('basket');
    }

    public function index()
    {
        $order = (new Basket())->get_order();

        return view('catalog.basket', compact('order'));
    }

    public function create_order()
    {
        $storages = Storage::all();
        $order = (new Basket())->get_order();

        return view('orders.form-order' , compact('storages', 'order') );
    }

    public function store_order(CreateOrderRequest $request)
    {
        (new Basket())->save_order($request->all());
        session()->flash('info', 'Ваш заказ принят.');

        return redirect()->route("catalog");
    }
}
