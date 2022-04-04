@extends('layouts.main-wide')

@section('title')Каталог@endsection

@section('content')
<div class="d-flex catalog">
    <!-- Левая меню и фильтр товаров -->
    <div class="col-2">
        <ul class="list-group">
            @foreach($aliases as $alias)
                <a class="text-decoration-none
                @if(isset($current_alias))
                    @if($current_alias == $alias->alias) active @endif"
                @endif
                 href="{{ route('catalog-directory-alias', $alias->alias) }}">
                    <li class="list-group-item list-group-item-action">
                            {{ $alias->name }}
                    </li>
                </a>
            @endforeach
        </ul>
    </div>


    <!-- Сами товары -->
    @foreach($items as $item)
        <div class="col-2 me-4 p-1 card">
            <div class="cart-img-wrapper">
                <img class="rounded" src="{{ Storage::url($item->short_image) }}" alt="Маленькое изображение">
            </div>
            <div class="card-body">
                <h5 class="card-title">{{$item->name}}</h5>
                <p class="card-text">{{$item->describ}}</p>
                <div class="d-flex mt-4">
                    <span class="">Цена:</span>
                    <span class="cart-price ms-auto">{{$item->price}}</span>
                </div>


                <div class="d-flex mt-3">
                    <a class="btn btn-primary" href={{ route('catalog-item',[
                    'directory_alias' => $item->directory->alias,
                    'item_alias' => $item->alias
                    ] ) }}>
                    Подробнее</a>
                    <form class="d-inline ms-auto" action="{{ route('add_to_basket', $item->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="amount" value="1">

                        <button type="submit" class="btn btn-danger">В корзину</button>
                    </form>
                </div>
            </div>
        </div>

    @endforeach

</div>


@endsection
