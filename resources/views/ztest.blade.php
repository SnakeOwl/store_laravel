@extends('layouts.main')

@section('title','Пложения и условия')

@section('content')
@if( session()->has('path') )
path
{{ Storage::disk('public')->url(session()->get('path')) }}
    <img src="{{ Storage::disk('public')->url(session()->get('path')) }}" alt="">
@endif

<form class="" action="{{ route('test_submit') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image">
    <input type="submit" value="send">
</form>
@endsection
