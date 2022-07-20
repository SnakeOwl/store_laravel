@extends('layouts.main-wide')

@section('title')Каталог@endsection

@section('content')
<section class="catalog d-flex">
    <div class="col-12 col-xl-2 d-none d-xl-block">
        @include('catalog.include.filter')
    </div>

    <div class="row w-100 justify-content-around ">
    <!-- Сами товары -->
    @foreach($items as $item)
        <div class="col-12 col-md-6 col-lg-4 me-xl-1 col-xxl-3 mb-3 p-1  card">
            <div class="img-wrapper">
                <a href={{ route('catalog-item',[
                'category_alias' => $item->category->alias,
                'item_alias' => $item->alias
                ] ) }}>
                <img class="rounded" src="{{ Storage::url($item->short_image) }}" alt="Маленькое изображение">
                </a>
            </div>
            <div class="card-body">
                <h5 class="title">
                        <a class="text-dark" href={{ route('catalog-item',[
                        'category_alias' => $item->category->alias,
                        'item_alias' => $item->alias
                        ] ) }}>
                        {{$item->name}}</a>
                </h5>
                <p class="text">{!! $item->get_description() !!}</p>
                <div class="d-flex mt-4">
                    <span class="">Цена:</span>
                    <span class="cart-price ms-auto">{{$item->price}}</span>
                </div>


            </div>
            <div class="card-footer">
                <div class="d-flex mt-3">
                    <a class="bttn blue" href={{ route('catalog-item',[
                    'category_alias' => $item->category->alias,
                    'item_alias' => $item->alias
                    ] ) }}>
                    Подробнее</a>

                    @if ($item->is_available())
                        <form class="d-inline ms-auto" action="{{ route('add_to_basket', $item->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="amount" value="1">

                            <button class="bttn red" type="submit">В корзину</button>
                        </form>
                    @else
                        <button class="bttn blue d-inline ms-auto" disabled>Нет в наличии</button>
                    @endif
                </div>
            </div>
        </div>

    @endforeach

    @if(isset($items))
        {{ $items->links() }}
    @endif
    </div>
</section>


@endsection
