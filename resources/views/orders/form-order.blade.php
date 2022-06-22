@extends('layouts.main')

@section('title', 'Оформление заказа')

@section('content')
<div class="container">
    <h3>Оформление заказа</h3>
    <form action="{{ route('basket-confirm') }}" method="post">
        @csrf

        <div class="input-group mb-3">
            <label for="name" class="input-group-text">Имя:</label>
            <input class="form-control" type="text" id="name" name="name" maxlength="255" placeholder="">
        </div>

        <div class="input-group mb-3">
            <label class="input-group-text" for="delivery_method">Способ Доставки</label>
            <select class="form-select" name="delivery_method" id="delivery_method">
                <option selected value="Доставка курьером">Доставка курьером</option>
                <option value="Доставка почтой">Доставка почтой</option>
                <option value="Доставка до точки самовывоза">Доставка до точки самовывоза</option>
            </select>
        </div>

        <div id="payment-type-1">
            <!-- данные для курьера и почты -->

            <div id="payment-type-2" class="d-none">
                <!-- данные для почты -->
                <div class="input-group mb-3">
                    <label for="post_index" class="input-group-text">Почтовый индекс:</label>
                    <input class="form-control" type="text" id="post_index" name="post_index" maxlength="10" placeholder="123456">
                </div>
            </div>

            <div class="input-group mb-3">
                <label for="address" class="input-group-text">Адрес:</label>
                <input class="form-control" type="text" id="address" name="address" maxlength="255" placeholder="г.Москва, ул.Советская 21">
            </div>
        </div>

        <div class="d-none" id="payment-type-3">
            @isset($storages)
                <div class="container">
                    @if ( count($storages) > 0 )
                    @foreach ($storages as $storage)
                    <div class="card mb-3">
                        <div class="card-header">
                            <input type="radio" name="storage_id" value="{{ $storage->id }}" id="{{ $storage->id }}">
                            <label for="{{ $storage->id }}">{{ $storage->name }}</label>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                Адрес: {{ $storage->address }} <br>
                                @isset($storage->phone)
                                    Телефон: {{ $storage->phone }} <br>
                                @endisset
                                Время работы:
                                {!! $storage->get_schedule() !!}
                            </p>
                        </div>
                    </div>


                    @endforeach
                    @endif
                </div>
            @else
                <p>В нашем магазине нету точек самовывоза, пожалуйста выберите друго способ доставки.</p>
            @endisset


        </div>

        <div class="input-group mb-3">
            <label for="phone" class="input-group-text">Контактный телефон:</label>
            <span class="input-group-text">+375</span>
            <input class="form-control" type="tel" id="phone" name="phone" maxlength="20" placeholder="29 123-4567" required>
            <span for="name" class="input-group-text">*</span>
        </div>

        <div class="input-group mb-3">
            <label class="input-group-text" for="payment_method">Способ оплаты</label>
            <select class="form-select" name="payment_method" id="payment_method">
                <option selected value="Оплата картой">Оплата картой</option>
                <option value="Оплата при получении">Оплата при получении</option>
                <option value="Оплата через ЕРИП">Оплата через ЕРИП</option>
            </select>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Сумма оплаты:</span>
            <span class="input-group-text">{{ $order->get_full_price() }}</span>
        </div>


        <button class="bttn green" type="submit" name="submit">Оформить заказ</button>
    </form>
</div>


@endsection
