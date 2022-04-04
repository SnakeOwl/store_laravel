@extends('layouts.admin')

@isset($storage)
    @section('title','Редактирование склада (магазина)')
@else
    @section('title','Добавление склада (магазина)')
@endisset

@section('content')
<form
@isset($storage)
    action="{{ route('storages.update' , $storage->id) }}"
@else
    action="{{route('storages.store')}}"
@endisset
    method="post">
    @csrf

    @isset($storage)
        @method('PUT')
    @endisset

    <div class="input-group mb-3">
        <label for="name" class="input-group-text">Название:</label>
        <input class="form-control" value="@isset($storage){{ $storage->name }}@endisset" type="text" id="name" name="name" maxlength="255" placeholder="Троечка" required>
        <span for="name" class="input-group-text">*</span>
    </div>

    <div class="input-group mb-3">
        <label for="address" class="input-group-text">Адрес:</label>
        <input class="form-control" value="@isset($storage){{ $storage->address }}@endisset" type="text" id="address" name="address" maxlength="255" placeholder="г.Москва, ул.Победителей, д.12" required>
        <span class="input-group-text">*</span>
    </div>

    <div class="input-group mb-3">
        <label for="phone" class="input-group-text">Телефон (не обязательно):</label>
        <input class="form-control" value="@isset($storage){{ $storage->phone }}@endisset" type="text" id="phone" name="phone" maxlength="255" placeholder="+375 (29) 123-45-67">
    </div>


        <div class="form-floating mb-3">
            <textarea class="form-control h-100" name="schedule" id="schedule" rows="8" cols="80" placeholder="">@isset($storage){{ $storage->schedule }}@endisset</textarea>
            <label for="schedule">Расписание</label>
        </div>

    <a class="btn btn-outline-primary" href="{{ route('storages.index') }}">К общему списку</a>
    <button class="btn btn-success" type="submit">Сохранить</button>
</form>

@endsection
