@extends('layouts.layout')

@section('title', 'Academic Performances')

@section('styles')
<style>
    .parallax-performance {
        background-image: url('/frontend/images/parallel4.jpg');
        background-attachment: fixed;
        background-size: cover;
        background-position: center;
        padding: 80px 0;
        color: #fff;
    }

    .overlay-bg-performance {
        background-color: rgba(0, 0, 0, 0.65);
        padding: 50px 30px;
        border-radius: 20px;
    }

    .performance-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        position: relative;
        border: 2px solid rgba(0, 123, 255, 0.2);
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        animation: fadeSlideUp 0.6s ease-in-out forwards;
        opacity: 0;
    }

    .performance-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.25);
        border-color: rgba(0, 123, 255, 0.4);
    }

    .performance-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 15px 15px 0 0;
    }

    .performance-card h5 {
        color: #007bff;
        font-weight: bold;
        padding: 15px 10px 5px;
        margin: 0;
        text-align: center;
    }

    .performance-card p {
        padding: 0 15px;
        color: #444;
        font-weight: 500;
        font-size: 0.95rem;
        text-align: center;
    }

    .icon-overlay {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: #007bff;
        color: #fff;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        transition: transform 0.6s ease;
        z-index: 2;
    }

    .icon-overlay:hover {
        background-color: #0056b3;
        transform: rotate(360deg);
    }

    .performance-card a {
        display: block;
        color: #007bff;
        font-weight: 600;
        padding: 10px 15px;
        text-align: center;
        background-color: #f1f1f1;
        border-radius: 0 0 15px 15px;
        text-decoration: none;
        transition: all 0.3s ease-in-out;
    }

    .performance-card a:hover {
        background-color: #007bff;
        color: #fff;
    }

    @keyframes fadeSlideUp {
        0% {
            transform: translateY(30px);
            opacity: 0;
        }
        100% {
            transform: translateY(0px);
            opacity: 1;
        }
    }
</style>
@endsection
@section('hero_title', 'Academic Performances')
@section('content')
<div class="parallax-performance">
    <div class="container overlay-bg-performance">
        

        @if($performances->isEmpty())
            <div class="alert alert-warning bg-light text-dark text-center">No academic performances available at the moment.</div>
        @else
            <div class="row">
                @foreach($performances as $performance)
                    <div class="col-md-4 mb-4 d-flex align-items-stretch">
                        <div class="performance-card w-100">
                            <!-- Image -->
                            @if($performance->image_url)
                                <img src="{{ $performance->image_url }}" alt="{{ $performance->student_name }}">
                            @else
                                <img src="https://via.placeholder.com/300x200" alt="No Image Available">
                            @endif

                            <!-- Icon -->
                            <div class="icon-overlay">
                                <i class="fas fa-graduation-cap"></i>
                            </div>

                            <!-- Content -->
                            <h5>{{ $performance->student_name }}</h5>
                            <p><strong>Class:</strong> {{ $performance->class }}</p>
                            <p><strong>Roll No:</strong> {{ $performance->roll_number }}</p>
                            <p><strong>Term:</strong> {{ $performance->term }}</p>
                            <p><strong>Year:</strong> {{ $performance->year }}</p>
                            <p><strong>Grade:</strong> {{ $performance->grade }}</p>

                            <!-- Link -->
                            <a href="{{ route('frontend.academic_performances.show', $performance->id) }}">
                                <i class="fas fa-eye me-1"></i> View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
