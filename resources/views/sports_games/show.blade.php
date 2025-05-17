@extends('layouts.layout')

@section('title', $sportsGame->title)

@section('content')
<div class="container py-5">
    <div class="card shadow-lg rounded-4 border-0">
        @if($sportsGame->image_url)
            <img src="{{ $sportsGame->image_url }}" class="card-img-top rounded-top-4" alt="{{ $sportsGame->title }}" style="height: 400px; object-fit: cover;">
        @else
            <div class="card-img-top rounded-top-4 bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 400px;">
                No Image Available
            </div>
        @endif

        <div class="card-body">
            <h2 class="card-title text-primary">{{ $sportsGame->title }}</h2>
            <p><strong>Category:</strong> {{ $sportsGame->category ?? 'Not Specified' }}</p>
            <p><strong>Coach:</strong> {{ $sportsGame->coach_name ?? 'Not Specified' }}</p>
            <p><strong>Contact:</strong> {{ $sportsGame->contact_number ?? 'Not Available' }}</p>
            <p>{{ $sportsGame->description }}</p>
            <a href="{{ route('frontend.sports_games.index') }}" class="btn btn-secondary">Back to Sports & Games</a>
        </div>
    </div>
</div>
@endsection
