@extends('layouts.main')

@section('title','Связь с администрацией')

@section('content')

<div class="container d-flex">
    <div class="mx-auto">
        <h2>Форма обратной связи</h2>
            <form class="col-12" action="{{ route('support.store') }}" method="post">
                @csrf
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="name">Введите имя:</label>
                        <input class="form-control" type="text" id="name" name="name" minlength="2" maxlength="255" placeholder="Алексей Иванович" required>
                    </div>

                    <div class="col-6">
                        <label for="email">Введите ваш email:</label>
                        <input class="form-control" type="text" id="email" name="email" minlength="5" maxlength="255" placeholder="email.gmail.com" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="">
                        <label for="message">Сообщение:</label>
                        <textarea class="form-control" name="message" id="message" rows="6" cols="80" minlength="8" required></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="">
                        <button class="bttn blue w-100" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-envelope-plus" viewBox="0 0 20 20">
                                <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z"/>
                                <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 0 0 1 0v-1h1a.5.5 0 0 0 0-1h-1v-1a.5.5 0 0 0-.5-.5Z"/>
                            </svg>
                            Отправить
                        </button>
                    </div>
                </div>
            </form>
        </div>

</div>

@endsection
