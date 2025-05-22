@extends('layouts.layout')

@section('title', 'Student Field Trips and Tours')
@section('hero_title', 'Student Field Trips and Tours')

@section('content')

<!-- Parallax Background Wrapper -->
<style>
    .parallax-bg {
        background-image: url('/frontend/images/parallel21.jpg');
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
        background-color: rgba(0, 0, 0, 0.35); /* dark overlay */
        z-index: -1;
    }

    .trip-card {
        background: rgba(255, 255, 255, 1); /* transparent white */
        border-radius: 20px;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        backdrop-filter: blur(5px);
    }

    .trip-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
    }

    .trip-card img {
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
        height: 250px;
        object-fit: cover;
    }

    .trip-card .card-body {
        padding: 1.5rem;
    }

    .trip-card .btn {
        border-radius: 50px;
    }

    .trip-title {
        color: #fff;
        text-align: center;
        font-size: 2.5rem;
        margin-bottom: 40px;
        font-weight: bold;
    }

    .no-trips {
        background-color: rgba(255, 255, 255, 0.85);
        padding: 2rem;
        border-radius: 12px;
    }
</style>

<div class="parallax-bg">
    <div class="container">
        

        @if($trips->isEmpty())
            <div class="alert alert-warning text-center no-trips">No field trips available at the moment.</div>
        @else
            <div class="row">
                @foreach($trips as $trip)
                    <div class="col-md-6 col-lg-4 mb-5">
                        <div class="trip-card">
                            @if($trip->image_url)
                                <img src="{{ $trip->image_url }}" class="w-100" alt="{{ $trip->title }}">
                            @else
                                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 250px;">
                                    No Image
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title text-primary fw-bold">{{ $trip->title }}</h5>
                                <p class="card-subtitle text-black  mb-2">{{ $trip->location }}</p>
                                <p class="mb-2 text-secondary">
                                    <strong>Start:</strong> {{ date('d M Y', strtotime($trip->start_date)) }}<br>
                                    <strong>End:</strong> {{ date('d M Y', strtotime($trip->end_date)) }}<br>
                                    <strong>Contact:</strong> {{ $trip->contact_person }} ({{ $trip->contact_number }})
                                </p>
                                <p class="card-text text-black">{{ Str::limit($trip->description, 100) }}</p>
                                <a href="{{ route('frontend.field_trips.show', $trip->id) }}" class="btn btn-primary btn-sm w-100 mt-3">
                                    View Details
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
