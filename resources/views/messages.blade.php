@extends('layouts.main')

@section('content')
   @foreach($data as $el)
        <div class="alert alert-info">
            <h3>{{ $el->name }}</h3>
            <small>{{ $el->email }}</small>
            <p>{{ $el->message }}</p>
            <a href="{{ route('a-contact-message', $el->id) }}" class="btn btn-warning">detail</a>
            
        </div>
   @endforeach
@endsection

@section('title')
    messages
@endsection

@section('aside')
    @parent
    <p>additional text</p>
@endsection