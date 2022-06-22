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
                <input class="form-control" type="text" value="@isset($courier){{ $courier->name }}@endisset" id="name" name="name" maxlength="128" placeholder="Шпиц Александр Владимирович" required>
            </div>

            <div class="mb-3">
                <label for="email">Логин:</label>
                <input class="form-control" type="text" value="@isset($courier){{ $courier->name }}@endisset" id="name" name="name" maxlength="128" placeholder="Шпиц Александр Владимирович" required>
            </div>


            <div class="mb-3">
                <label for="password">Пароль:</label>
                <input class="form-control" type="password" value="@isset($courier){{ $courier->password }}@endisset" id="city" name="city" maxlength="128" placeholder="Москва">
                @isset($courier)
                <p class="text-muted">При вводе пароля, он затрет старый пароль</p>
                @endif
            </div>

            <button class="bttn blue w-100" type="submit">Сохранить</button>
        </div>

    </div>

</form>

@endsection
