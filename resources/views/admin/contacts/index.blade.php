@extends('layouts.admin')

@section('title', 'Форма обратной связи')

@section('content')

<h2>Сообщения</h2>
<a class="btn btn-outline-primary" href="{{ route('contacts.create') }}">Добавить нового курьера</a>
<table class="table table-striped table-hover">
    <thead>
        <th>id</th>
        <th>Имя</th>
        <th>email</th>
        <th>Сообщение</th>
        <th>Активность</th>
    </thead>
    <tbody>

    @foreach($contacts as $el)
        <tr>
            <td>{{ $el->id }}</td>
            <td>{{ $el->name }}</td>
            <td>{{ $el->email }}</td>
            <td>{{ $el->message }}</td>
            <td>{{ $el->active }}</td>
            <td><a class="btn btn-success" href="{{ route ( 'contacts.show', $el->id) }}">Просмотреть</a></td>
        </tr>
    @endforeach

    </tbody>
</table>


@endsection
