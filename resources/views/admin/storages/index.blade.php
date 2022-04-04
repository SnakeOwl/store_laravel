@extends('layouts.admin')

@section('title','Склады (Магазины)')

@section('content')

<h2>Все склады (магазины)</h2>
<a class="btn btn-outline-primary" href="{{ route('storages.create') }}">Добавить новый склад (магазин)</a>
<table class="table table-striped table-hover">
    <thead>
        <th>#</th>
        <th>Имя</th>
        <th>Адрес</th>
        <th>Телефон (опционально)</th>
        <th>Расписание</th>
    </thead>
    <tbody>

    @foreach($storages as $el)
        <tr>
            <td>{{ $el->id }}</td>
            <td>{{ $el->name }}</td>
            <td>{{ $el->address }}</td>
            <td>{{ $el->phone }}</td>
            <td>
                @php
                    echo str_replace (array("\r\n", "\r", "\n"), '<br>', $el->schedule);
                @endphp
            </td>
            <td><a class="btn btn-success" href="{{ route ( 'storages.edit', $el->id) }}">Редактировать</a></td>
            <td>
                <form class="" action="index.html" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" data-method="delete" href="{{ route ('storages.destroy', $el->id) }}">Удалить</button>
                </form>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>


@endsection
