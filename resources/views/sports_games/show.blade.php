@extends('layouts.layout')

@section('title', $sportsGame->title)
@section('hero_title', 'Sports & Games')

@section('styles')
<style>
    .parallax-sports-detail {
        background-image: url('/frontend/images/parallel6.jpg');
        background-attachment: fixed;
        background-size: cover;
        background-position: center;
        padding: 80px 0;
        color: #fff;
        position: relative;
    }

    .overlay-detail-bg {
        
        padding: 50px 30px;
        border-radius: 15px;
    }

    .sport-detail-card {
        background-color: rgba(255, 255, 255, 0.5);
        border: 2px solid rgba(0, 2, 5, 0.25);
        border-radius: 20px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .sport-detail-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
        border-color: rgba(0, 0, 0, 0.4);
    }

    .sport-img-detail {
        height: 400px;
        object-fit: cover;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }

    .btn-back {
        background-color: rgba(108, 117, 125, 0.85);
        color: #fff;
        border: none;
    }

    .btn-back:hover {
        background-color: rgba(108, 117, 125, 1);
    }
</style>
@endsection

@section('content')
<div class="parallax-sports-detail">
    <div class="container overlay-detail-bg">
        <div class="sport-detail-card">
            @if($sportsGame->image_url)
                <img src="{{ $sportsGame->image_url }}" class="sport-img-detail w-100" alt="{{ $sportsGame->title }}">
            @else
                <div class="d-flex align-items-center justify-content-center bg-secondary text-white sport-img-detail">
                    <i class="fas fa-image fa-2x me-2"></i> No Image Available
                </div>
            @endif

            <div class="card-body px-4 py-4">
                <h2 class="card-title text-primary mb-3">
                    <i class="fas fa-futbol me-2"></i>{{ $sportsGame->title }}
                </h2>
                <p><strong>Category:</strong> {{ $sportsGame->category ?? 'Not Specified' }}</p>
                <p><strong>Coach:</strong> {{ $sportsGame->coach_name ?? 'Not Specified' }}</p>
                <p><strong>Contact:</strong> {{ $sportsGame->contact_number ?? 'Not Available' }}</p>
                <hr>
                <p class="text-muted">{{ $sportsGame->description }}</p>

                <a href="{{ route('frontend.sports_games.index') }}" class="btn btn-back mt-3">
                    <i class="fas fa-arrow-left me-2"></i> Back to Sports & Games
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
