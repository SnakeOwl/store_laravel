<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('layouts.include.head')

    <script src="/js/admin.js"></script>
    <title>@yield('title')</title>
</head>
<body>
    @include('layouts.include.header')


    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-2">
                <div class="">
                    Разделы для управления:
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="{{ route ('orders.index') }}">Заказы</a></li>
                        <li class="list-group-item"><a href="{{ route ('items.index') }}" class="">Товары</a></li>
                        <li class="list-group-item"><a href="{{ route ('directories.index') }}" class="btn btn-outline-primary">Разделы</a></li>
                        <li class="list-group-item"><a href="">Пользователи</a></li>
                        <li class="list-group-item"><a href="{{ route ('couriers.index') }}" class="btn btn-outline-primary">Курьеры</a></li>
                        <li class="list-group-item"><a href="{{ route ('storages.index') }}" class="btn btn-outline-primary">Склады</a></li>
                        <li class="list-group-item"><a href="{{ route ('contacts.index') }}" class="btn btn-outline-primary">Форма обратной связи</a></li>
                        <li class="list-group-item"><a href="#" class="text-danger">Комментарии к товарам</a></li>
                        <li class="list-group-item"><a href="#" class="text-danger">Акции</a></li>
                        <li class="list-group-item"><a href="#" class="text-danger">Промокоды</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-10">
                @yield('content')
            </div>
        </div>
    </div>
    @include('layouts.include.footer')
</body>
</html>
