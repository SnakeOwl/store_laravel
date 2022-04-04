@extends('layouts.main')

@section('title', 'Регистрация')
@section('content')
<div class="form-signin text-center">

    <form class="" action="{{ route('register') }}" method="post">
        @csrf
        <h1>
            <x-logo/>
        </h1>
        <h1 class="h3 mb-3 fw-normal">Форма регистрации</h1>


        @if ($errors->any())
            <div class="alert alert-danger">Регистрация отклонена</div>
        @endif

        <!-- name -->
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-floating mb-3">
            <input type="text" :value="old('name')" maxlength="255" class="form-control"  name="name" id="name" placeholder="Виктор Вадимович">
            <label for="name">ФИО</label>
        </div>

        <!-- email -->
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-floating mb-3">
            <input type="email" :value="old('email')" name="email" maxlength="255" class="form-control" id="email" placeholder="name@google.com" required>
            <label for="email">Email:</label>
        </div>

        <!-- password -->
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control" id="password" placeholder="Пароль" required>
            <label for="password">Пароль</label>
        </div>

        <!-- confirm password -->
        <div class="form-floating mb-3">
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Пароль" required>
            <label for="password_confirmation">Повторите пароль</label>
        </div>

        <input class="btn btn-success" type="submit" value="Отправить">

    </form>
</div>
@endsection
