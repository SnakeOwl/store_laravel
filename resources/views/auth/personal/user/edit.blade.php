@extends('layouts.main')

@section('title', 'Редактирование персональных данных')
@section('content')
    <section>
        <form action="{{ route('users.update', $user->id) }}" method="post">
            <div class="row">

                <div class="mx-auto col-3">
                    @csrf
                    @method('put')

                    <div class="col-12 mb-3">
                        <label for="name" class="form-label">Имя:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="email" class="form-label">email:</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="phone" class="form-label">Телефон:</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="password" class="form-label">Новый пароль:</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="password_confirmation" class="form-label">Повторите пароль:</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                    </div>
                    <div class="col-12">
                        <button class="bttn blue w-100" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check2" viewBox="0 0 18 18">
                                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                            </svg>
                            Сохранить
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
