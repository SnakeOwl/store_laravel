@extends('layouts.admin')

@section('title','Создание товара')

@section('content')
<form action="{{route('items.store')}}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="input-group mb-3">
        <label for="name" class="input-group-text">Название:</label>
        <input class="form-control" type="text" id="name" name="name" maxlength="256" placeholder="Шахматы" required>
        <span for="name" class="input-group-text">*</span>
    </div>

    <div class="input-group mb-3" title="Алиас - это то, что будет в адресной строке браузера. Обычно этот параметр задают исходя из названия.">
        <label for="directory_id" class="input-group-text">Раздел:</label>

            @if (count($directories) > 0)
                <select class="form-select" name="directory_id" id="directory_id">
                    @foreach ($directories as $dir)
                        <option value=" {{ $dir->id }} ">{{ $dir->name }}</option>
                    @endforeach

                </select>
            @else
                <span class="input-group-text">Необходимо создать структуру разделов товаров.</span>
            @endif

        <span class="input-group-text">*</span>
    </div>

    <div class="input-group">
        <label for="short-image" class="input-group-text">Маленькое изображение:</label>
        <input class="form-control" type="file" id="short-image" name='short-image' accept="image">
    </div>
    <p class="text-secondary md-3">Можно и большое изображение, оно будет отображаться на карточке товара в каталоге.</p>

    <div class="form-floating mb-3">
        <textarea class="form-control h-100" name="describ" id="describ" rows="8" cols="80" placeholder="Описываю товар"></textarea>
        <label for="describ">Описание</label>
    </div>

    <div class="input-group mb-3">
        <label class="input-group-text" for="price">Цена:</label>
        <input class="form-control" type="text" name="price" id="price" min="0" title="Вводимый формат: '101.05'" placeholder="101.20">
        <span class="input-group-text">*</span>
    </div>

    <div class="input-group mb-3">
        <label class="input-group-text" for="amount">Количество:</label>
        <input class="form-control" min="0" max="65535" value="1" type="number" name="amount" id="amount" required>
        <span class="input-group-text">*</span>
    </div>

    <div class="item-params-container">
        <p class="h3 mt-4">Характеристики товара:</p>
        <table class="table table-striped" id="table-params">
            <thead>
                <tr>
                    <th>Наименование характеристики</th>
                    <th>Значение</th>
                    <th>Удаление</th>
                </tr>
            </thead>
            <tbody>
                <!-- этот блок tr для JS скрипта по копированию. Он используется при нажатии на кнопку "Ещё". -->
                <tr class="d-none" id="item-param-clone">
                    <td><input class="w-100" type="text" name="param_key[]" maxlength="255"></td>
                    <td><input class="w-100" type="text" name="param_val[]" maxlength="255"></td>
                    <td><button class="btn btn-danger delete-parent-parent-tag" type="button">удалить параметр</button></td>
                </tr>
                <!-- !!! -->

                @for ($i = 0; $i < 6; $i++)
                <tr>
                    <td><input class="w-100" type="text" name="param_key[]" maxlength="255"></td>
                    <td><input class="w-100" type="text" name="param_val[]" maxlength="255"></td>
                    <td><button class="btn btn-danger delete-parent-parent-tag" type="button">удалить параметр</button></td>
                </tr>
                @endfor

            </tbody>
        </table>

        <div class="d-grid gap-2 col-6 mt-2 mx-auto">
            <button id="item-param-add" class="btn btn-primary" type="button">Ещё</button>
        </div>
    </div>

    <p class="h3">Галерея:</p>
    <div class="input-group mb-4">
        <span class="input-group-text" for="color-need" title="Слайдеры будут размером 1280 х 800.">Выберите файлы для галереи:</span>
        <input class="form-control" type="file" name="galery-images[]" multiple="multiple" accept="image">
    </div>

    <div class="input-group mb-3">
        <label class="input-group-text" for="discont">Скидка (в процентах):</label>
        <input class="form-control" type="number" name="discont" id="discont" min="0" max="100" title="Скидка в процентах" placeholder="0">
        <span class="input-group-text">%</span>
    </div>


    <a class="btn btn-outline-primary" href="{{ route('items.index') }}">К товарам</a>
    <button class="btn btn-outline-danger" type="reset">Сбросить</button>
    <button class="btn btn-success" type="submit">Сохранить</button>
</form>

@endsection
