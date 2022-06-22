@extends('layouts.admin')

@isset($courier)
    @section('title','Редактирование курьера')
@else
    @section('title','Добавление курьера')
@endisset

@section('content')

<form
    @isset($courier)
        action="{{ route('couriers.update' , $courier->id) }}"
    @else
        action="{{ route('couriers.store') }}"
    @endisset
    method="post">
    @csrf
    @isset($courier)
        @method('PUT')
    @endisset

    <div class="row mb-3">
        <div class="col-3">
            <h3>
                @isset($courier)
                    Редактирование курьера
                @else
                    Создание курьера
                @endisset
            </h3>
            <div class="mb-3">
                <label for="name">Имя:</label>
                <input class="form-control" type="text" value="@isset($courier){{ $courier->name }}@endisset" id="name" name="name" minlegth="2" maxlength="255" placeholder="Шпиц Александр Владимирович" required>
            </div>

            <div class="mb-3">
                <label for="email">Email:</label>
                <input class="form-control" type="email" value="@isset($courier){{ $courier->email }}@endisset" id="email" name="email" minlegth="2" maxlength="255" placeholder="courier" required>
            </div>


            <div class="mb-3">
                <label for="password">Пароль:</label>
                <input class="form-control" type="password" value="" id="password" name="password" minlegth="4" maxlength="16">
                @isset($courier)
                    <p class="text-muted">При вводе пароля, он затрет старый пароль</p>
                @endif
            </div>

            <button class="bttn blue w-100" type="submit">Сохранить</button>
        </div>

    </div>

</form>

@endsection
