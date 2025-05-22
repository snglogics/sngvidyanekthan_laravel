@extends('layouts.layout')

@section('title', $trip->title)
@section('hero_title', 'Trip Details')

@section('content')

<!-- Parallax Background & Custom Styles -->
<style>
    .parallax-bg {
        background-image: url('/frontend/images/parallel11.jpg');
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        padding: 80px 0;
        z-index: 1;
    }

    .parallax-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.65);
        z-index: -1;
    }

    .trip-detail-card {
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(8px);
        border-radius: 20px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        color: white;
    }

    .trip-detail-card img {
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
        height: 400px;
        object-fit: cover;
    }

    .trip-detail-card .card-body {
        padding: 2.5rem;
    }

    .trip-detail-card .btn {
        border-radius: 30px;
        padding: 0.6rem 1.5rem;
    }

    .trip-info p {
        margin-bottom: 1rem;
        font-size: 1.1rem;
    }

    .trip-info i {
        margin-right: 8px;
        color: #ffc107;
    }
</style>

<!-- Include Bootstrap Icons (optional if already added globally) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="parallax-bg">
    <div class="container">
        <div class="trip-detail-card">
            @if($trip->image_url)
                <img src="{{ $trip->image_url }}" class="card-img-top" alt="{{ $trip->title }}">
            @else
                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 400px;">
                    <i class="bi bi-image fs-1 me-2"></i> No Image Available
                </div>
            @endif

            <div class="card-body">
                <h2 class="card-title text-warning mb-3"><i class="bi bi-geo-alt-fill me-2"></i>{{ $trip->title }}</h2>
                <p class="card-subtitle text-white-50 mb-4"><i class="bi bi-map"></i> {{ $trip->location }}</p>

                <div class="trip-info ">
                    <p class='text-white'><i class="bi bi-calendar-event "></i> <strong>Start Date:</strong> {{ date('d M Y', strtotime($trip->start_date)) }}</p>
                    <p class='text-white'><i class="bi bi-calendar-check"></i> <strong>End Date:</strong> {{ date('d M Y', strtotime($trip->end_date)) }}</p>
                    <p class='text-white'><i class="bi bi-person-lines-fill"></i> <strong>Contact:</strong> {{ $trip->contact_person }} ({{ $trip->contact_number }})</p>
                    <p class='text-white'><i class="bi bi-info-circle-fill"></i> {{ $trip->description }}</p>
                </div>

                <a href="{{ route('frontend.field_trips.index') }}" class="btn btn-outline-light mt-4"><i class="bi bi-arrow-left-circle"></i> Back to Trips</a>
            </div>
        </div>
    </div>
</div>

@endsection
