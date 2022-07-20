@extends('layouts.main')

@section('title', 'Управление заказом')
@section('content')

<section>
    <h3>Управление заказом #{{$order->id}}</h3>
    <div class="container">
        <!-- primary options -->
        <form class="mb-3" action="">
            @csrf
            @method('put')
            <div class="row mb-3">
                <div class="col-3">
                    <label class="form-label">Имя:</label>
                    <input type="text" class="form-control" value="{{ $order->name }}" disabled>
                </div>
                <div class="col-3">
                    <label for="phone" class="form-label">Телефон для связи:</label>
                    <input type="phone"  name="phone" id="phone"  class="form-control" value="{{ $order->phone }}" >
                </div>
                <div class="col-3">
                    <label class="form-label">Статус заказа:</label>
                    <input type="text" class="form-control" value="{{ $order->status }}" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-3">
                    <label for="delivery_method" class="form-label">Способ доставки:</label>
                    <input type="text"  name="delivery_method" id="delivery_method"  class="form-control" value="{{ $order->delivery_method }}" >
                </div>
                <div class="col-3">
                    <label for="address" class="form-label">Адрес:</label>
                    <input type="text"  name="address" id="address"  class="form-control" value="{{ $order->address }}" >
                </div>
                <div class="col-3">
                    <label for+"post_index" class="form-label">Почтовый индекс:</label>
                    <input type="text" name="post_index" id="post_index"  class="form-control" value="{{ $order->post_index }}" >
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-3">
                    <label class="form-label">Сумма для оплаты заказа:</label>
                    <input type="text" class="form-control" value="{{ $order->cost }}" disabled>
                </div>
                <div class="col-3">
                    <label class="form-label">Способ оплаты:</label>
                    <input type="text" class="form-control" value="{{ $order->payment_method }}" disabled>
                </div>
                <div class="col-3">
                    <label class="form-label">Статус оплаты:</label>
                    <input type="text" class="form-control"
                    @if($order->payment_status == 0)
                        value="Не оплачено"
                    @else
                        value="Оплачено"
                    @endif
                     disabled>
                </div>
                <div class="col-3">
                    <label class="form-label">Скидка:</label>
                    <input type="text" class="form-control" value="{{ $order->discount }}" disabled>
                </div>
            </div>

            <div class="row">
                <button class="bttn blue" type="submit">Сохранить изменения</button>
            </div>
        </form>

        <!-- items -->
        <div class="row mb-4">
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
                        <td>{{$item->get_cost_for_amount()}}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <!-- additional options -->

        <div class="row mb-3">
            <!-- couriers -->
            @isset($couriers)
            <div class="col-4">

                <h4>Закрепление курьера</h4>
                <form action="{{route('set-courier', $order->id)}}" method="post">
                    @csrf
                    <select class="form-select mb-3" name="courier_id" id="courier">
                        @foreach($couriers as $courier)
                            <option value=" {{ $courier->id }} ">{{ $courier->name }} (#{{$courier->id}})</option>

                        @endforeach
                    </select>
                    <p class="text-secondary"><span class="text-danger">Внимание!</span> Закрепление дополнительного курьера не перекроет закрепленный заказ у первого курьера.</p>
                    <button class="bttn blue">Закрепить курьера</button>
                </form>
            </div>
            @endisset


            <!-- status -->
            <div class="col-4">
                <h4>Изменение статуса заказа</h4>
                <form action="{{route('change-status', $order->id)}}  " method="post">
                    @csrf
                    <select class="form-select mb-3" name="status" id="status">
                        @foreach ([ 'Обрабатывается', 'Отправлен',  'Получен', 'Отменен'] as $text)
                            <option value=" {{ $text }} " @if ($order->status == $text) selected @endif>{{ $text }}</option>
                        @endforeach

                    </select>
                    <button class="bttn blue w-100">Изменить статус</button>
                </form>
            </div>
        </div>


        <!-- order-paid -->
        <div class="row">
            <form class="d-inline" action="{{route('order-paid', $order->id)}}" method="post">
                @csrf
                <button class="bttn green" type="submit">Заказ "Оплачен"</a>
                </form>

        </div>
    </div>
</section>

@endsection
