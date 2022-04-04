@extends('layouts.main')

@section('title'){{$item->name}}@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-4">
                <div class="w-auto detail-img-wrapper">
                    <img class="w-100 rounded" src="{{ Storage::url($item->short_image) }}" alt="Маленькое изображение">
                </div>
            </div>
            <div class="col-6">
                <h1>{{$item->name}}</h1>
                <p>
                    @php
                        echo $item->get_description()
                    @endphp
                </p>
                <p>Цена: {{$item->price}}</p>
            </div>
            <div class="col-2">
                <div class="text-end">
                    <form class="d-inline ms-auto" action="{{ route('add_to_basket', $item->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="amount" value="1">

                        <button type="submit" class="btn btn-danger">В корзину</button>
                    </form>
                </div>
            </div>
        </div>

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

        <div class="text-end">
            <form class="d-inline ms-auto" action="{{ route('add_to_basket', $item->id) }}" method="post">
                @csrf
                <input type="hidden" name="amount" value="1">

                <button type="submit" class="btn btn-danger">В корзину</button>
            </form>
        </div>
    </div>

@endsection
