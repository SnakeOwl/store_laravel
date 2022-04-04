@extends('layouts.admin')

@section('title', 'Товары')

@section('content')

<h2>Таблица всех товаров</h2>
<a class="btn btn-outline-primary" href="{{ route('items.create') }}">Добавить товар</a>
<table class="table table-striped table-hover">
    <thead>
        <th>id</th>
        <th>Название</th>
        <th>Изображение</th>
        <th>Цена</th>
        <th>Количество</th>
        <th>Раздел</th>
    </thead>
    <tbody>

    @foreach($items as $el)
        <tr>
            <td>{{ $el->id }}</td>
            <td>{{ $el->name }}</td>
            <td><img width="200" src="{{ Storage::url($el->short_image) }}"></td>
            <td>{{ $el->price }}</td>
            <td>{{ $el->amount }}</td>

            <td>{{ $el->directory->name }}</td>
            <td><a class="btn btn-success" href="{{route( 'items.edit', $el->id)}}">Редактировать</a></td>
            <td>
                <form action="{{route( 'items.destroy', $el->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Удалить</button>
                </form>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>

@endsection
