@extends('layouts.main')

@section('title', 'Корзина')

@section('content')


<div class="container-fluid basket">
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
                                <button type="submit" class="btn-remove w-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-patch-minus-fill" viewBox="0 0 16 16">
                                        <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM6 7.5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1 0-1z"/>
                                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                </button>
                            </form>

                            <form class="d-inline" action="{{ route('add_to_basket', $item->id) }}" method="post">
                                @csrf

                                <button type="submit" class="btn-add w-auto" id='{{$item->id}}'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
                                    </svg>
                            </button>
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
    <a class="bttn green" href="{{ route('basket-order') }}">Оформить заказ</a>
    @endif
</div>
@endsection
