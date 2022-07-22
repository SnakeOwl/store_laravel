@extends('layouts.main')

@section('title'){{$item->name}}@endsection

@section('content')
    <div class="container position-relative pb-5">
        <div class="row">

            <!-- slider -->
            <div class="col-12 col-xl-6 mb-2">
                <div class="w-auto detail-img-wrapper">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ Storage::url($item->short_image) }}" class="d-block w-100" alt="...">
                            </div>

                            @foreach($item->images as $image)
                            <div class="carousel-item">
                                <img src="{{ Storage::url($image->image) }}" class="d-block w-100" alt="...">
                            </div>

                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>


                </div>
            </div>

            <!-- description -->
            <div class="col-12 col-xl-6">
                <h1>{{$item->name}}</h1>
                <p class="text-justify">
                    {!! $item->get_description() !!}
                </p>
                <p>Цена: {{$item->price}}</p>
            </div>
        </div>

        <!-- properties -->
        <div class="row mt-5">
            <div class="col-12">
                <h3>Характеристики</h3>
                <table class="table">
                    @foreach ($item->parameters as $param)
                    <tr>
                        <td>{{ $param->param_name }}</td>
                        <td>{{ $param->param_value }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <!-- "to basket" button -->
        <div class="position-absolute bottom-0 end-0 text-center">
            @if ($item->is_available())
            <form class="d-inline ms-auto" action="{{ route('add_to_basket', $item->id) }}" method="post">
                @csrf
                <input type="hidden" name="amount" value="1">

                <button type="submit" class="bttn red">В корзину</button>
            </form>
            @else
            <span>Товара нет в наличии</span>
            <br>
            <span>Сообщить вам о поступлении товара? </span>
            <form class="d-inline ms-auto" action="{{route('subscription.store')}}" method="post">
                @csrf
                <input type="hidden" name="item_id" value="{{$item->id}}">
                <input class="form-control mb-2" type="email" name="email" id="email" placeholder="my_email@gmail.com" required>
                <button class="bttn blue ms-auto">Подписаться</button>
            </form>
            @endif
        </div>
    </div>

@endsection
