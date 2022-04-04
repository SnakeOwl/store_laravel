<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrdersController extends Controller
{
    // отображает заказы одного пользователя
    public function show_personal_orders()
    {

    }

    // отображает список заказов в админке
    public function index()
    {
        return view('admin.orders.index', [
            'orders' => Order::where('basket_status', 1)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $order_id = session('order_id');
        return view('orders.form-order' , ['order' => Order::find($order_id) ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order_id = session('order_id');
        if (is_null($order_id))
        {
            return redirect()->route('catalog');
        }

        $order = Order::find($order_id);

        $order->save_order( $request->input('payment_method', null),
                            $request->input('delivery_method', null),
                            $request->input('address', null),
                            $request->input('post_index', null),
                            $request->input('phone', null),
                            $request->input('name', null)
                        );

        session()->flash('success', 'Ваш заказ принят.');

        return redirect()->route("catalog");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
