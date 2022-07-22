@extends('layouts.admin')
@if ( isset($item) )
    @section('title','Редактирование товара')
@else
    @section('title','Создание товара')
@endif

@section('content')
<h3>
    @isset($item)
        Редактирование товара
    @else
        Создание товара
    @endisset
</h3>
<form
    @isset ($item)
        action="{{route('items.update', $item->id)}}"
    @else
        action="{{route('items.store')}}"
    @endisset

    method="post" enctype="multipart/form-data">
    @csrf
    @isset($item)
        @method('put')
    @endisset

    <div class="row mb-3">
        <div class="col-3">
            <label for="name">Название:</label>
            <input class="form-control" type="text" id="name" name="name" value="{{ old('name', isset($item)? $item->name: null) }}" minlength="2" maxlength="256" placeholder="Шахматы" required>
        </div>

        <div class="col-3" title="Алиас - это то, что будет в адресной строке браузера. Обычно этот параметр задают исходя из названия.">
            <label for="category_id" >Категория товара:</label>
                @if (count($categories) > 0)
                    <select class="form-select" name="category_id" id="category_id">
                        @foreach ($categories as $category)
                            <option value=" {{ $category->id }} ">{{ $category->name }}</option>
                        @endforeach

                    </select>
                @else
                    <span class="input-group-text">Необходимо создать структуру разделов товаров.</span>
                @endif
        </div>

        <div class="col-3">
            <label for="price">Цена:</label>
            <input class="form-control" value="{{ old('price', isset($item)? $item->price: null) }}" type="text" name="price" id="price" min="0" title="Вводимый формат: '101.05'" placeholder="101.20" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-6">
            <label for="description">Описание</label>
            <textarea class="form-control" name="description" id="description" rows="8" cols="80" placeholder="Быстрая и хорошая мышь" required>{{ old('description', isset($item)? $item->description: null) }}</textarea>
        </div>

        <div class="col-3">
            <label for="amount">Количество:</label>
            <input class="form-control" min="0" max="65535" value="{{ old('amount', isset($item)? $item->amount: 1) }}" type="number" name="amount" id="amount" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-3">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="new" value="1" @if(isset($item) && $item->new != 1) @else checked @endif name="new">
                <label class="form-check-label" for="new">Новинка</label>
            </div>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="hit" value="1" @if(isset($item) && $item->hit == 1) checked @endif name="hit">
                <label class="form-check-label" for="hit">Хит продаж</label>
            </div>
        </div>

        <div class="col-3">
            <div class="">
                <label for="discount">Скидка (в процентах):</label>
                <input class="form-control" value="{{ old('discount', isset($item)? $item->discount: 0) }}" type="number" name="discount" id="discount" min="0" max="100" title="Скидка в процентах" placeholder="0">
            </div>
        </div>
    </div>

    <div class="row md-3">
        <div class="col-12">
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
                        <td><input class="form-control w-100" type="text" name="param_key[]" maxlength="255"></td>
                        <td><input class="form-control w-100" type="text" name="param_val[]" maxlength="255"></td>
                        <td>
                            <button class="bttn red delete-parent-parent-tag" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 18 18">
                                <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                            </button>
                        </td>
                    </tr>
                    <!-- !!! -->

                    @isset($item)
                        @foreach ($item->parameters as $param)

                            <tr>
                                <td><input class="form-control w-100" type="text" name="param_key[]" value="{{ $param->param_name }}" maxlength="255"></td>
                                <td><input class="form-control w-100" type="text" name="param_val[]" value="{{ $param->param_value }}" maxlength="255"></td>
                                <td>
                                    <button class="bttn red delete-parent-parent-tag" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 18 18">
                                        <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        @for ($i = 0; $i < 4; $i++)
                        <tr>
                            <td><input class="form-control w-100" type="text" name="param_key[]" maxlength="255"></td>
                            <td><input class="form-control w-100" type="text" name="param_val[]" maxlength="255"></td>
                            <td>
                                <button class="bttn red delete-parent-parent-tag" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 18 18">
                                    <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                                </button>
                            </td>
                        </tr>
                        @endfor
                    @endisset

                </tbody>
            </table>

            <div class="d-grid gap-2 col-6 mt-2 mx-auto">
                <button id="item-param-add" class="bttn blue" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 18 18">
                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="row md-3">
        <div class="col-6">
            <p class="h5">Маленькое изображение:</p>
            @isset($item)
                <img src="{{ Storage::url($item->short_image) }}" width="300">
            @endisset
            <input class="form-control" type="file" id="short-image" name='short-image' accept="image">
            <p class="text-secondary">Если загрузите изображение, то оно заменит старое.</p>
        </div>
    </div>

    <div class="row mb-3">
        <h3>Галерея:</h3>
        <div class="col-6">
            <div class="input-group mb-4">
                <span class="input-group-text" for="color-need" title="Слайдеры будут размером 1280 х 800.">Выберите файлы для галереи:</span>
                <input class="form-control" type="file" name="galery-images[]" multiple="multiple" accept="image">
            </div>
            @isset($item)
                <div class="text-secondary">Загруженные картинки будут добавляться к уже имеющимся.</div>
            @endisset
        </div>
    </div>
    @isset($item)
    <div class="row mb-3">
        <div class="col-12">
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
                        <td>
                            <button class="bttn red delete-parent-parent-tag">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 18 18">
                                    <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                                Удалить изображение
                            </button>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    @endisset


    <div class="row mb-3">
        <div class="col-12 text-center">
            <button class=" bttn blue" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 18 18">
                  <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                </svg>
                Сохранить
            </button>
        </div>
    </div>

</form>

@endsection


@isset($item)
@else
@endisset
