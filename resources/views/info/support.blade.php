@extends('layouts.main')

@section('title','Техническая поддержка')

@section('content')

<div class="container text-justify">
    <h1 class="my-3">Техническая поддержка</h1>
    <p>График работы отдела технической поддержки: Понедельник - Пятница: с 9.30 AM до 6.00 PM МСК</p>
    <p>Контакты:</p>
    <p>Телефоны отдела технической поддержки:</p>

    <p>Страны СНГ: </p>
    <a class="hover-color-primary" href="tel:74951234567" itemprop="telephone" content="74951234567"> 7 (495) 123-45-67</a> <br>
    <a class="hover-color-primary" href="tel:88001234567" itemprop="telephone" content="88001234567"> 8 (800) 123-45-67</a> <span class="text-muted">(Бесплатно по России)</span>

    <p>Написать письмо в отдел технической поддержки через <a href="{{ route('support.create') }}" class="hover-color-primary">форму</a>  на сайте.</p>

    <h2 class="my-3">Драйверы</h2>
    <p>Информация о драйверах будет указана на странице товара. Если такой информации нет, значит наличие специальных драйверов, для данного товара не требуется.</p>
</div>

@endsection
