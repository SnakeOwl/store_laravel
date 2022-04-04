@extends('layouts.admin')

@section('title')Акции@endsection

@section('content')
<div class="container">
    <h2>Добавление новой акции</h2>
    <div class="row">
        <form class="col-4" action="admin/order/add" method="post">
            @csrf
            <div class="form-floating">
                <input class="form-control" type="text" id="name" name="name" placeholder="Василиса Премудрая">
                <label for="name">Название</label>
            </div>
            <div class="input-group">
                <span class="input-group-text">Скидка:</span>
                <input class="form-control" type="number" min="0" max="100" id="discont" name="discont" placeholder="10" >
                <span class="input-group-text">%</span>
            </div>
            <div class="form-floating">
                <textarea class="form-control" name="description" id="description" rows="8" cols="80" placeholder="Описываю день"></textarea>
                <label for="description">Описание</label>
            </div>
            <div>
                <label for="one-day-discont">Скидка на один день</label>
                <input type="date" name="one-day-discont" id="one-day-discont" value="">
            </div>
            <hr>
            <div>
                <label for="date-start">Дата начала скидки</label>
                <input type="date" name="date-start" id="date-start" value="">

                <label for="date-end">Дата окончания скидки</label>
                <input type="date" name="date-end" id="date-end" value="">
                <span class="text-secondary">Скидка продлится от даты начала, до даты окончания.</span>
            </div>

            <button class="btn btn-success" type="submit">Создать</button>
        </form>
    </div>

    <h2>Таблица акций</h2>
    <div class="row">
        @foreach($data as $el)
        {{ $el }}
        @endforeach
    </div>
</div>
@endsection
