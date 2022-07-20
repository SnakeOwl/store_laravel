@extends('layouts.main')

@section('title', 'Корзина')

@section('content')


<div class="container-fluid basket">
    <h1>Корзина</h1>
    @if (isset($order))
    <div class="overflow-auto mb-3">

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
                        <div class="d-flex justify-content-between">
                            <form class="d-inline" action="{{ route('remove_from_basket', $item->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn-remove w-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-patch-minus-fill" viewBox="0 0 16 16">
                                        <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM6 7.5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1 0-1z"/>
                                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                </button>
                            </form>
                            <span>{{$item->pivot->amount}}</span>

                            <form class="d-inline" action="{{ route('add_to_basket', $item->id) }}" method="post">
                                @csrf

                                <button type="submit" class="btn-add w-auto" id='{{$item->id}}'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                    <td class="text-end"><span>{{$item->price}}</span></td>
                    <td class="text-end"><span>{{ $item->get_cost_for_amount() }}</span></td>
                    <td>
                    </td>
                    <td>

                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <div class="row mb-3">
        <div class="col-12 position-relative text-success">
            <span >Общая стоимость</span>
            <span class="position-absolute top-0 end-0 me-5">
                {{ $order->get_full_cost() }}
            </span>
        </div>
    </div>

    <a class="bttn green d-block d-md-inline text-center" href="{{ route('basket-order') }}">Оформить заказ</a>
    @endif
</div>
@endsection
