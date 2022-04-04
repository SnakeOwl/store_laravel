@extends('layouts.main')

@section('title') change record @endsection

@section('content')
    <h1>contact</h1>
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $er)
                <li>{{ $er }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('contact-update-submit', $data->id) }}" method='post'>
        @csrf
        
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name='name' value="{{ $data->name }}" placeholder='Name' id='name' class='form-control'>
        </div>

        <div class="form-group">
            <label for="email">email:</label>
            <input type="email" name='email' value="{{ $data->email }}" placeholder='email@gmail.com' id='email' class='form-control'>
        </div>

        <div class="form-group">
            <label for="message">Message:</label>
            <textarea name="message" id="message" cols="30" rows="10" class='form-control' placeholder='Message'>{{ $data->message }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection

