@extends('layouts.admin')

@section('title', 'Заказы')

@section('content')


<h2>Таблица всех заказов</h2>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>id</th>
            <th>Курьер (id)</th>
            <th>Промокод (id)</th>
            <th>Адрес</th>
            <th>Имя покупателя</th>
            <th>Статус оплаты</th>
            <th>Метод оплаты</th>
            <th>Почта</th>
            <th>Скидка</th>
            <th>Телефон</th>
            <th>Цена</th>
            <th>Статус</th>
            <th>Дата создания</th>
        </tr>
    </thead>
    <tbody>

    @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->courier_id }}</td>
            <td>{{ $order->promocode_id }}</td>
            <td>{{ $order->address }}</td>
            <td>{{ $order->name }}</td>
            <td>{{ $order->payment_status }}</td>
            <td>{{ $order->payment_method }}</td>
            <td>{{ $order->post_index }}</td>
            <td>{{ $order->discont }}</td>
            <td>{{ $order->phone }}</td>
            <td>{{ $order->price }}</td>
            <td>{{ $order->status }}</td>
            <td>{{ $order->date_created }}</td>

            <td><a class="btn btn-success" href="{{ route( 'orders.edit', $order->id) }}">Редактировать</a></td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection
