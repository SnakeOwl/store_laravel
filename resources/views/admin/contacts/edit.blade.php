@extends('layouts.admin')

@section('title', 'Письма пользователей')

@section('content')
<section>
    <div class="row mb-3">
        <div class="col-3">
            <label>Имя:</label>
            <input class="form-control" value="{{$contact->name}}" type="text" disabled>
        </div>

        <div class="col-3">
            <label>email:</label>
            <input class="form-control" value="{{$contact->email}}" type="text" disabled>
        </div>
    </div>

    <div class="row mb-3">
        <p class="mb-0">Сообщение:</p>
        <div class="col-6">
            <textarea class="form-control" rows="6" cols="80" disabled>{{ $contact->message }}</textarea>
        </div>
    </div>

    <div class="row">
        <form class="col-6" action="{{ route ('contacts.update', $contact->id) }}" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="active" value="0">
            <button class="bttn blue w-100" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                    <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                    <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                </svg>
                Прочитано
            </button>
        </form>
    </div>
</section>
@endsection
