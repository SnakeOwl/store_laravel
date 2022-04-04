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

    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="input-group mb-3">
        <label for="name" class="input-group-text">Имя:</label>
        <input class="form-control" type="text" value="@isset($courier){{ $courier->name }}@endisset" id="name" name="name" maxlength="128" placeholder="Шпиц Александр Владимирович" required>
        <span class="input-group-text">*</span>
    </div>

    @error('city')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="input-group mb-3">
        <label for="city" class="input-group-text">Город (не обязательно):</label>
        <input class="form-control" type="text" value="@isset($courier){{ $courier->city }}@endisset" id="city" name="city" maxlength="128" placeholder="Москва">
    </div>

    @error('active')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="form-check">
        <input class="form-check-input" type="radio" name="active" value="1" id="active"
        @isset($courier)
            @if($courier->active == 1)
                checked
            @endif
        @endisset
        >
        <label class="form-check-label" for="active">Активировать</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="active" value="0" id="unactive"
        @isset($courier)
            @if($courier->active == 0)
                checked
            @endif
        @endisset
        >
        <label class="form-check-label" for="unactive">Деактивировать</label>
    </div>

    <a class="btn btn-outline-primary" href="{{ route('couriers.index') }}">К общему списку</a>
    <button class="btn btn-success" type="submit">Сохранить</button>
</form>

@endsection
