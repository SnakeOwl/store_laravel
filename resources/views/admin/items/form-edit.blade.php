@extends('layouts.admin')

@section('title','Изменение товара')

@section('content')
<form action="{{route('items.update', $item->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="input-group mb-3">
        <label for="name" class="input-group-text">Название:</label>
        <input class="form-control" value="{{$item->name}}" type="text" id="name" name="name" maxlength="256" placeholder="Шахматы" required>
        <span for="name" class="input-group-text">*</span>
    </div>

    <div class="input-group mb-3" title="Алиас - это то, что будет в адресной строке браузера. Обычно этот параметр задают исходя из названия.">
        <label for="section" class="input-group-text">Раздел:</label>

            @if (count($directories) > 0)
                <select class="form-select" name="section" id="section">
                    @foreach ($directories as $dir)
                        <option value=" {{ $dir->id }} "
                            @if ($dir->id == $item->directory_id)
                                selected
                            @endif
                            >{{ $dir->name }}</option>
                    @endforeach

                </select>
            @else
                <span class="input-group-text">Необходимо создать структуру разделов товаров.</span>
            @endif

        <span class="input-group-text">*</span>
    </div>

    <div class="">
        <p class="h5">Маленькое изображение:</p>
        <img src="{{ Storage::url($item->short_image) }}" width="300">
        <input class="form-control" type="file" id="short-image" name='short-image' accept="image">
        <p class="text-primary md-3">Если загрузите изображение, то оно заменит старое.</p>

    </div>


    <div class="form-floating mb-3">
        <textarea class="form-control h-100" name="describ" id="describ" rows="8" cols="80" placeholder="Описываю товар">{{$item->describ}}</textarea>
        <label for="describ">Описание</label>
    </div>

    <div class="input-group mb-3">
        <label class="input-group-text" for="price">Цена:</label>
        <input class="form-control"  value="{{$item->price}}" type="text" name="price" id="price" min="0" title="Вводимый формат: '101.05'" placeholder="101.20">
        <span for="name" class="input-group-text">*</span>
    </div>

    <div class="input-group mb-3">
        <label class="input-group-text" for="amount">Количество:</label>
        <input class="form-control" value="{{$item->amount}}" min="0" max="65535" type="number" name="amount" id="amount" required>
        <span for="name" class="input-group-text">*</span>
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

                @foreach ($item->parameters as $param)

                    <tr>
                        <td><input class="w-100" type="text" name="param_key[]" value="{{ $param->param_name }}" maxlength="255"></td>
                        <td><input class="w-100" type="text" name="param_val[]" value="{{ $param->param_value }}" maxlength="255"></td>
                        <td><button class="btn btn-danger delete-parent-parent-tag" type="button">удалить параметр</button></td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <div class="d-grid gap-2 col-6 mt-2 mx-auto">
            <button id="item-param-add" class="btn btn-primary" type="button">Ещё</button>
        </div>
    </div>

    <p class="h3">Галерея:</p>
    <div class="input-group mb-4">
        <span class="input-group-text" for="color-need" title="Слайдеры будут размером 1280 х 800.">Выберите файлы для добавления:</span>
        <input class="form-control" type="file" name="galery-images[]" multiple="multiple" accept="image">
    </div>

    <p class="h4">Существующие картинки галереи:</p>
    <table class="table">
        <thead>
            <tr>
                <td>Изображение</td>
                <td>Удаление</td>
            </tr>
        </thead>
        <tbody>

            @foreach ($item->images as $img)
            <tr>
                <td>
                    <img src="{{ Storage::url($img->image) }}" width="200px">
                    <input type="hidden" name="old_images[]" value="{{$img->image}}">
                </td>
                <td><button class="btn btn-danger delete-parent-parent-tag">Удалить изображение</button></td>
            </tr>
            @endforeach

        </tbody>
    </table>

    <div class="input-group mb-3">
        <label class="input-group-text" for="discont">Скидка (в процентах):</label>
        <input class="form-control" value="{{ $item->discont }}" type="number" name="discont" id="discont" min="0" max="100" title="Скидка в процентах" placeholder="0">
        <span class="input-group-text">%</span>
    </div>

    <button class="btn btn-success" type="submit">Сохранить</button>
    <a class="btn btn-secondary" href="{{route('items.index')}}">Отмена</a>
</form>

@endsection
