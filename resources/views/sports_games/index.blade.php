@extends('layouts.layout')

@section('title', 'Sports & Games')
@section('hero_title', 'Sports & Games')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<style>
    .parallax-sports {
        background-image: url('/frontend/images/parallel6.jpg');
        background-attachment: fixed;
        background-size: cover;
        background-position: center;
        padding: 80px 0;
        color: #fff;
        position: relative;
    }

    .overlay-bg {
        background-color: rgba(0, 0, 0, 0.6);
        padding: 60px 30px;
        border-radius: 15px;
    }

    .sport-card {
        background-color: rgba(255, 255, 255, 0.9);
        border: 2px solid rgba(0, 123, 255, 0.25);
        border-radius: 20px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .sport-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.25);
        border-color: rgba(0, 123, 255, 0.5);
    }

    .sport-img {
        height: 250px;
        object-fit: cover;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }

    .card-body {
        padding: 1.5rem;
        flex-grow: 1;
    }

    .card-title i {
        color: #198754;
    }

    .btn-view {
        background-color: rgba(13, 110, 253, 0.85);
        color: white;
        border: none;
    }

    .btn-view:hover {
        background-color: rgba(13, 110, 253, 1);
    }
</style>
@endsection

@section('content')
<div class="parallax-sports">
    <div class="container overlay-bg">
        <h2 class="text-center text-white mb-5">Explore Our Sports & Games</h2>

        @if($sports->isEmpty())
            <div class="alert alert-warning text-center fw-bold bg-light text-dark">No sports or games available at the moment.</div>
        @else
            <div class="row gy-4">
                @foreach($sports as $sport)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="sport-card">
                        @if($sport->image_url)
                            <img src="{{ $sport->image_url }}" class="sport-img w-100" alt="{{ $sport->title }}">
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-secondary text-white sport-img">
                                <i class="fas fa-image fa-2x me-2"></i> No Image
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title text-primary">
                                <i class="fas fa-futbol me-2"></i>{{ $sport->title }}
                            </h5>
                            <p class="card-text text-muted">{{ Str::limit($sport->description, 100, '...') }}</p>
                        </div>
                        <div class="px-3 pb-3">
                            <a href="{{ route('frontend.sports_games.show', $sport->id) }}" class="btn btn-view w-100">
                                <i class="fas fa-arrow-right me-1"></i> View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
