@extends('layouts.admin')

@isset($storage)
    @section('title','Редактирование склада (магазина)')
@else
    @section('title','Добавление склада (магазина)')
@endisset

@section('content')

<h3 class="mb-3">
    @isset($storage)
        Редактирование склада (магазина)
    @else
        Создание склада (магазина)
    @endisset
</h3>

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


    <div class="row mb-3">
        <div class="col-3">
            <label for="name">Название:</label>
            <input class="form-control" value="@isset($storage){{ $storage->name }}@endisset" type="text" id="name" name="name" maxlength="255" placeholder="Троечка" required>
        </div>

        <div class="col-3">
            <label for="address">Адрес:</label>
            <input class="form-control" value="@isset($storage){{ $storage->address }}@endisset" type="text" id="address" name="address" maxlength="255" placeholder="г.Москва, ул.Победителей, д.12" required>
        </div>

        <div class="col-3">
            <label for="phone">Телефон:</label>
            <input class="form-control" value="@isset($storage){{ $storage->phone }}@endisset" type="text" id="phone" name="phone" maxlength="255" placeholder="+375 (29) 123-45-67">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-6">
            <label for="schedule">Расписание</label>
            <textarea class="form-control" name="schedule" id="schedule" rows="4" cols="80" placeholder="">@isset($storage){{ $storage->schedule }}@endisset</textarea>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <button class="bttn blue w-100" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 18 18">
                    <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                </svg>
                Сохранить
            </button>

        </div>
    </div>

</form>

@endsection
