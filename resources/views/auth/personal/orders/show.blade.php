@extends('layouts.main')

@section('title', 'Редактирование персональных данных')
@section('content')
    <section>
        <h1>Заказ #{{$order->id}}</h1>
        <div class="container">
            <div class="row mb-3">
                <div class="col-3">
                    <label class="form-label">Имя:</label>
                    <input type="text" class="form-control" value="{{ $order->name }}" disabled>
                </div>
                <div class="col-3">
                    <label class="form-label">Телефон для связи:</label>
                    <input type="text" class="form-control" value="{{ $order->phone }}" disabled>
                </div>
                <div class="col-3">
                    <label class="form-label">Статус заказа:</label>
                    <input type="text" class="form-control" value="{{ $order->status }}" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-3">
                    <label class="form-label">Способ доставки:</label>
                    <input type="text" class="form-control" value="{{ $order->delivery_method }}" disabled>
                </div>
                <div class="col-3">
                    <label class="form-label">Адрес:</label>
                    <input type="text" class="form-control" value="{{ $order->address }}" disabled>
                </div>
                <div class="col-3">
                    <label class="form-label">Почтовый индекс:</label>
                    <input type="text" class="form-control" value="{{ $order->post_index }}" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-3">
                    <label class="form-label">Стоимость заказа:</label>
                    <input type="text" class="form-control" value="{{ $order->price }}" disabled>
                </div>
                <div class="col-3">
                    <label class="form-label">Способ оплаты:</label>
                    <input type="text" class="form-control" value="{{ $order->payment_method }}" disabled>
                </div>
                <div class="col-3">
                    <label class="form-label">Статус оплаты:</label>
                    <input type="text" class="form-control" value="{{ $order->payment_status }}" disabled>
                </div>

                <div class="col-3">
                    <label class="form-label">Скидка:</label>
                    <input type="text" class="form-control" value="{{ $order->discount }}" disabled>
                </div>
            </div>
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Название товара</th>
                            <th>Количество</th>
                            <th>Стоимость</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach( $items as $item )
                        <tr>
                            <td>
                                <a class="" href={{ route('catalog-item',[
                                'category_alias' => $item->category->alias,
                                'item_alias' => $item->alias
                                ] ) }}>
                                    {{$item->name}}
                                </a>
                            </td>
                            <td>{{$item->pivot->amount}}</td>
                            <td>{{$item->get_price_for_amount()}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </section>
@endsection
