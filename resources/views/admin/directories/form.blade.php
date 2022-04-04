@extends('layouts.admin')


@isset($directory)
    @section('title','Редактирование директории')
@else
    @section('title','Добавление директории')
@endisset

@section('content')
<form
@isset($directory)
    action="{{ route('directories.update' , $directory->id) }}"
@else
    action="{{route('directories.store')}}"
@endisset
 method="post">
    @csrf

    @isset($directory)
        @method('PUT')
    @endisset

    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="input-group mb-3">
        <label for="name" class="input-group-text">Название:</label>
        <input class="form-control" value="{{ old('name', isset($directory)? $directory->name: null) }}" type="text" id="name" name="name" maxlength="256" placeholder="Клавиатура" required>
        <span for="name" class="input-group-text">*</span>
    </div>

    @error('alias')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="input-group mb-3">
        <label for="alias" class="input-group-text">Алиас:</label>
        <input class="form-control" value="{{ old('name', isset($directory)? $directory->alias: null) }}" type="text" id="alias" name="alias" maxlength="256" placeholder="keyboard" required>
        <span for="name" class="input-group-text">*</span>
    </div>

    <div class="input-group mb-3">
        <label for="parent" class="input-group-text">Родительский раздел:</label>

        <select class="form-select" id="parent" name="id_parent">
            <option value="">Не выбран</option>

            @foreach ($directories as $dir)
                <option value="{{ $dir->id }}"
                @isset($directory)
                    @if ( $directory->id_parent == $dir->id )
                        selected
                    @endif
                @endisset
                >{{ $dir->name }}</option>
            @endforeach

        </select>
    </div>

    <a class="btn btn-outline-primary" href="{{ route('directories.index') }}">К разделам</a>
    <button class="btn btn-success" type="submit">Сохранить</button>
</form>

@endsection
