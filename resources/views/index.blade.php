@extends('layouts.main-wide')

@section('title', @config('app.name') . ' Главная')

@section('content')

<x-slider-v1/>

<x-mini-catalog-v1/>


@endsection
