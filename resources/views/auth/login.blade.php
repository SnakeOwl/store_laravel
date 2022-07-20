@extends('layouts.main')

@section('title', 'Вход')
@section('content')
<div class="form-signin text-center">

    <form class="" action="{{ route('login') }}" method="post">
        @csrf
        <h1>
            <x-logo/>
        </h1>
        <h1 class="h3 mb-3 fw-normal">Пожалуйста войдите</h1>

        <!-- email -->
        <div class="form-floating mb-3">
            <input type="email" :value="old('email')" name="email" class="form-control" id="email" placeholder="name@google.com" required autofocus>
            <label for="email">Email:</label>
        </div>

        <!-- password -->
        <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control" id="password" placeholder="Пароль" required>
            <label for="password">Пароль</label>
        </div>

        <!-- Remember Me -->
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me" name="remember"> Запомнить меня
            </label>
        </div>

        <input class="bttn blue w-100 mb-3" type="submit" value="Войти">
    </form>
    <p class="text-secondary text-start">
        Админ: administrator@gmail.com | administrator
        <br> <br>
        Курьер: courier1@gmail.com | courier1
    </p>

</div>

@endsection
