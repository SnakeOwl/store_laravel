@extends('layouts.main')

@section('title') {{$data->name}} @endsection

@section('content')
    <h1>{{ $data->name }}</h1>
   
    <div class="alert alert-info">
        <h3>{{ $data->name }}</h3>
        <small>{{ $data->email }}</small>
        <p>{{ $data->message }}</p>
        <a href="{{ route('contact-message-update', $data->id) }}" class="btn btn-warning">remake</a>
        <a href="{{ route('contact-delete', $data->id) }}" class="btn btn-danger">delete</a>
    </div>
   
@endsection



@section('aside')
    @parent
    <p>additional text</p>
@endsection