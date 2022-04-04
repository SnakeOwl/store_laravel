@extends('layouts.admin')

@section('title', 'Курьеры')

@section('content')

<h2>Таблица всех курьеров</h2>
<a class="btn btn-outline-primary" href="{{ route('couriers.create') }}">Добавить нового курьера</a>
<table class="table table-striped table-hover">
    <thead>
        <th>#</th>
        <th>Имя</th>
        <th>Город (опционально)</th>
        <th>Активность</th>
    </thead>
    <tbody>

    @foreach($couriers as $el)
        <tr>
            <td>{{ $el->id }}</td>
            <td>{{ $el->name }}</td>
            <td>{{ $el->city }}</td>
            <td>{{ $el->active }}</td>
            <td><a class="btn btn-success" href="{{ route ( 'couriers.edit', $el->id) }}">Редактировать</a></td>
            <td>
                <form action="{{ route ('couriers.destroy', $el->id) }}" method="post">
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
