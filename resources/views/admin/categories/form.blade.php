@extends('layouts.admin')


@isset($category)
    @section('title','Редактирование категории')
@else
    @section('title','Добавление категории')
@endisset

@section('content')
<h3>
    @isset($category)
        Редактирование категории
    @else
        Создание категории
    @endisset
</h3>

<form
@isset($category)
    action="{{ route('categories.update' , $category->id) }}"
@else
    action="{{route('categories.store')}}"
@endisset
 method="post">
    @csrf

    @isset($category)
        @method('PUT')
    @endisset


    <div class="col-3">
        <div class="mb-3">
            <label for="name">Название:</label>
            <input class="form-control" value="{{ old('name', isset($category)? $category->name: null) }}" type="text" id="name" name="name" maxlength="256" placeholder="Клавиатура" required>
        </div>

        <div class="mb-3">
            <label for="alias">Алиас:</label>
            <input class="form-control" value="{{ old('name', isset($category)? $category->alias: null) }}" type="text" id="alias" name="alias" maxlength="256" placeholder="keyboard" required>
            <div class="text-secondary">Алиас нужен для ссылок</div>
        </div>

        <div class="mb-3 d-none">
            <label for="parent">Родительский раздел:</label>

            <select class="form-select" id="parent" name="id_parent">
                <option value="">Не выбран</option>

                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}"
                    @isset($category)
                        @if ( $category->id_parent == $cat->id )
                            selected
                        @endif
                    @endisset
                    >{{ $cat->name }}</option>
                @endforeach

            </select>
        </div>

        <button class="bttn blue w-100" type="submit">Сохранить</button>
    </div>
</form>

@endsection
