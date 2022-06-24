@extends('layouts.main')

@section('title', 'Заказы')
@section('content')
    <section>
        <h1>Заказы</h1>
        <div class="overflow-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Статус оплаты</th>
                        <th>Способ оплаты</th>
                        <th>Способ доставки</th>
                        <th>Адрес</th>
                        <th>Стоимость (с учетом скидок)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>
                            <a href="{{ route( 'orders.show', $order->id ) }}">
                                {{$order->id}}
                            </a>
                        </td>
                        <td>{{$order->payment_status}}</td>
                        <td>{{$order->payment_method}}</td>
                        <td>{{$order->delivery_method}}</td>
                        <td>{{$order->address}}</td>
                        <td>{{$order->price}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
