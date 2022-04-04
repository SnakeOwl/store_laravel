@extends('layouts.main')

@section('title', 'Корзина')

@section('content')


<div class="container-fluid">
    <h1>Корзина</h1>
    @if (isset($order))
    <table class="table">
        <thead>
            <tr>
                <th>Изображение</th>
                <th>Название</th>
                <th>Количество</th>
                <th>Цена (за шт.)</th>
                <th>Стоимость</th>
            </tr>
        </thead>
        <tbody>

        @foreach($order->items as $item)
            <tr>
                <td><img src="{{ Storage::url($item->short_image) }}" width="200" alt="Изображение"></td>
                <td><span class="basket-item-name">{{$item->name}}</span></td>
                <td>
                    <div class="d-flex pe-5">
                        <div class="">{{$item->pivot->amount}}</div>

                        <div class="ms-auto">
                            <form class="d-inline" action="{{ route('remove_from_basket', $item->id) }}" method="post">
                                @csrf
                                <button type="submit" class="basket-btn-remove-item  cart-btn-basket btn-sm">-</button>
                            </form>

                            <form class="d-inline" action="{{ route('add_to_basket', $item->id) }}" method="post">
                                @csrf
                                <button type="submit" class="basket-btn-add-item btn-delete-from-basket btn-sm" id='{{$item->id}}'>+</button>
                            </form>
                        </div>
                    </div>

                </td>
                <td><span class="basket-item-price">{{$item->price}}</span></td>
                <td><span class="basket-item-price">{{ $item->get_price_for_amount() }}</span></td>
                <td>
                </td>
                <td>

                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4">Общая стоимость</td>
            <td> {{ $order->get_full_price() }} </td>
        </tr>
        </tbody>
    </table>
    <a class="btn btn-success" href="{{ route('basket-order') }}">Оформить заказ</a>
    @endif
</div>
@endsection
