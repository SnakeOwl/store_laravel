@extends('layouts.admin')

@section('title')Пользователи@endsection

@section('content')
<div class="container">
    <h2>Добавление нового пользователя</h2>
    <div class="row">
        <form action="admin/order/add" method="post">
        @csrf
            <div class="form-floating">
                <input class="form-control" type="text" id="name" name="name" placeholder="Василиса Премудрая">
                <label for="name">Имя</label>
            </div>
            <button class="btn btn-success" type="submit">Создать</button>
        </form>
    </div>

    <h2>Таблица пользователей</h2>
    <div class="row">
        @foreach($data as $el)
        {{ $el }}
        @endforeach
    </div>
</div>
@endsection
