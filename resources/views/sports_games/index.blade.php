@extends('layouts.layout')

@section('title', 'Sports & Games')

@section('content')
<div class="container py-5">
    <h2 class="text-center text-primary mb-5">Sports & Games</h2>

    @if($sports->isEmpty())
        <div class="alert alert-warning text-center">No sports or games available at the moment.</div>
    @else
        <div class="row">
            @foreach($sports as $sport)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-lg rounded-4 border-0">
                    @if($sport->image_url)
                        <img src="{{ $sport->image_url }}" class="card-img-top rounded-top-4" alt="{{ $sport->title }}" style="height: 250px; object-fit: cover;">
                    @else
                        <div class="card-img-top rounded-top-4 bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 250px;">
                            No Image
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $sport->title }}</h5>
                        <p class="card-text">{{ Str::limit($sport->description, 100) }}</p>
                        <a href="{{ route('frontend.sports_games.show', $sport->id) }}" class="btn btn-primary btn-sm w-100">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
