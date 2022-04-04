@extends('layouts.main')

@section('title','Связь с администрацией')

@section('content')

<div class="container">
    <h1>Форма обратной связи</h1>
    <form action="{{ route('support-form-store') }}" method="post">
        @csrf

        <div class="input-group mb-3">
            <label for="name" class="input-group-text">Введите имя:</label>
            <input class="form-control" type="text" id="name" name="name" maxlength="255" placeholder="Шпиц Александр Владимирович" required>
            <span for="name" class="input-group-text">*</span>
        </div>

        <div class="input-group mb-3">
            <label for="name" class="input-group-text">Введите ваш email:</label>
            <input class="form-control" type="text" id="email" name="email" maxlength="255" placeholder="email.gmail.com" required>
            <span for="name" class="input-group-text">*</span>
        </div>

        <div class="form-floating mb-3">
            <textarea class="form-control h-100" name="message" id="message" rows="8" cols="80" placeholder=""></textarea>
            <label for="message">Описание</label>
        </div>

        <input class="btn btn-outline-success" type="submit" value="Отправить" >
    </form>
</div>

@endsection
