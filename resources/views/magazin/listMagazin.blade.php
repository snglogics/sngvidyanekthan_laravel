@extends('layouts.layout')
@section('content')

@foreach($magazines as $magazine)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $magazine->title }}</h5>
            <a href="{{ route('magazines.show', $magazine->id) }}" class="btn btn-success">Read Now</a>
        </div>
    </div>
@endforeach
@endsection