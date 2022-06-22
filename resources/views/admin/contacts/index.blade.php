@extends('layouts.admin')

@section('title', 'Сообщения формы обратной связи')

@section('content')

<h2>Сообщения</h2>
<p class="text-muted">В этом разделе выводятся непрочитанные сообщения, поступающие от формы обратной связи.</p>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Имя</th>
            <th>email</th>
            <th>Сообщение</th>
        </tr>
    </thead>
    <tbody>

    @foreach($contacts as $el)
        <tr>
            <td>{{ $el->id }}</td>
            <td>{{ $el->name }}</td>
            <td>{{ $el->email }}</td>
            <td>{{ $el->message }}</td>
            <td>
                <a class="bttn blue" href="{{ route ( 'contacts.edit', $el->id) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-envelope-open" viewBox="0 0 20 20">
                        <path d="M8.47 1.318a1 1 0 0 0-.94 0l-6 3.2A1 1 0 0 0 1 5.4v.817l5.75 3.45L8 8.917l1.25.75L15 6.217V5.4a1 1 0 0 0-.53-.882l-6-3.2ZM15 7.383l-4.778 2.867L15 13.117V7.383Zm-.035 6.88L8 10.082l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738ZM1 13.116l4.778-2.867L1 7.383v5.734ZM7.059.435a2 2 0 0 1 1.882 0l6 3.2A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765l6-3.2Z"/>
                    </svg>
                    Открыть
                </a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>


@endsection
