@extends('layouts.admin')

@section('title', 'Разделы')

@section('content')

<h2>Таблица всех разделов</h2>
<a class="btn btn-outline-primary" href="{{ route('directories.create') }}">Добавить раздел</a>
<table class="table table-striped table-hover">
    <thead>
        <th>#</th>
        <th>Название</th>
        <th>Алиас</th>
        <th>Родитель</th>
        <th></th>
        <th></th>
    </thead>
    <tbody>

    @foreach($directories as $directory)
        <tr>
            <td>{{ $directory->id }}</td>
            <td>{{ $directory->name }}</td>
            <td>{{ $directory->alias }}</td>
            <td>{{ $directory->id_parent }}</td>

            <td><a class="btn btn-success" href="{{route( 'directories.edit', $directory->id)}}">Редактировать</a></td>
            <td>
                <form action="{{route( 'directories.destroy', $directory->id)}}" method="post">
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
