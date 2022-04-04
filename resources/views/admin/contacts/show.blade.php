@extends('layouts.admin')

@section('title', 'Форма обратной связи')

@section('content')

<form action="{{ route ('contacts.update', $record->id) }}" method="post">
    @csrf
    @method('put')

    <div class="input-group mb-3">
        <label for="name" class="input-group-text">Имя:</label>
        <input class="form-control" value="{{$record->name}}" type="text" id="name" name="name" maxlength="256" disabled>
    </div>

    <div class="input-group mb-3">
        <label for="email" class="input-group-text">email:</label>
        <input class="form-control" value="{{$record->email}}" type="text" id="email" name="email" maxlength="256" disabled>
    </div>

    <p class="mb-0">Сообщение:</p>
    <div class="form-floating mb-3">
        <textarea class="form-control h-100" name="message" id="message" rows="8" cols="80" disabled>{{ $record->message }}</textarea>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="active" id="active" value="1"
            @if($record->active == 1)
                checked
            @endif
        >
        <label class="form-check-label" for="active">
            Активировать
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="active" id="unactive" value="0"
            @if($record->active == 0)
                checked
            @endif
        >
        <label class="form-check-label" for="unactive">
            Деактивировать
        </label>
    </div>

    <a class="btn btn-primary" href="{{ route('contacts.index') }}">К списку</a>
    <input class="btn btn-success" type="submit" value="Сохранить">
</form>
@endsection
