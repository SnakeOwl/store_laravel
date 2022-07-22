<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\User;
use App\Models\Storage;



class OrderController extends Controller
{
    public function set_courier(Request $request, Order $order)
    {
        $order->users()->attach($request->courier_id);
        session()->flash('info', 'Курьер назначен');

        return redirect()->back();
    }

    public function change_status(Request $request, Order $order)
    {
        $order->update(['status' => $request['status']]);
        session()->flash('info', 'Статус изменен');

        return redirect()->back();
    }

    public function paid(Order $order)
    {
        $order->update(['payment_status' => 1]);

        session()->flash('info', 'Заказ оплачен');

        return redirect()->back();
    }

    // отображает заказы одного пользователя
    // active = false, отображает завершенные заказы
    public function show_personal_orders()
    {
        $orders = Auth::user()->orders()->active()->get();
        return view('auth.personal.orders.index', compact('orders'));
    }

    // отображает список заказов в админке
    public function index()
    {
        return view('admin.orders.index', [
            'orders' => Order::active()->get()
        ]);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
         $items = $order->items()->withTrashed()->get();
         return view( 'auth.personal.orders.show', compact('order', 'items') );
    }

    public function edit(Order $order)
    {
        $couriers = User::couriers()->get();
        $items = $order->items()->withTrashed()->get();
        return view('admin.orders.edit', compact('order', 'items', 'couriers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
