@extends('layouts.main')

@section('title')Оформление заказа@endsection

@section('content')

<div class="container">
    <h2>Добавление нового заказа</h2>
    <div class="row">
        <form action="{{route('order-add-submit')}}" method="post">
        @csrf
            <div class="form-floating">
                <select  class="form-select" id="payment-type" aria-label="Floating label select example" name="payment-method">
                    <option value="courier" selected>Курьером</option>
                    <option value="post">Почтой</option>
                    <option value="self">Самовывоз</option>
                </select>
                <label for="payment">Выберите способ доставки:</label>
            </div>

            <div class="form-floating">
                <input class="form-control" type="text" id="name" name="name" placeholder="Василиса Премудрая" required>
                <label for="name">Ваше имя</label>
            </div>
            <div class="form-floating">
                <input class="form-control" type="tel" id="phone" name="phone" placeholder="+375-29-123-45-67" required>
                <label for="phone">Ваш телефон</label>
            </div>


            <div id="payment-type-1" class="">
                <div class="form-floating">
                    <input class="form-control" type="text" id="address" name="address" placeholder="г.Москва, ул.Светская д.21 А">
                    <label for="address">Ваш адрес</label>
                </div>

                <div id="payment-type-2" class="d-none">
                    <div class="form-floating">
                        <input class="form-control" type="text" id="post" name="post" placeholder="г.Москва, ул.Светская д.21 А">
                        <label for="post">Почтовый индекс</label>
                    </div>
                </div>
            </div>

            <div id="payment-type-3" class="d-none">
                <div class="form-floating">
                    <select class="form-select" aria-label="Floating label select example" name="storage">
                        <option value="1" selected>Гомель, ул.Ленина 31а </option>
                        <option value="2">Гомель, ул.Советская 22</option>
                        <option value="3">Гомель, ул.Крестьянская 14</option>
                    </select>
                    <label for="payment">Выберите место доставки:</label>
                </div>
            </div>

            <button class="btn btn-success" type="submit">Оформить</button>
        </form>
    </div>
</div>

<script src="/js/order-form.js"></script>

@endsection
