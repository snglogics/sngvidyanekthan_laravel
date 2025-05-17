@extends('layouts.layout')

@section('title', 'Academic Performances')

@section('styles')
<style>
    .performance-card {
        background-color: #ffffff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
        position: relative;
    }

    .performance-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
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
        padding: 15px;
        margin: 0;
        text-align: center;
    }

    .performance-card p {
        padding: 0 15px 15px;
        color: #555;
        text-align: center;
        font-weight: 500;
    }

    .performance-card .icon-overlay {
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
        font-size: 24px;
        transition: all 0.3s ease-in-out;
        z-index: 10;
    }

    .performance-card .icon-overlay:hover {
        background-color: #0056b3;
        transform: rotate(360deg);
    }

    .performance-card a {
        display: block;
        color: #007bff;
        font-weight: 600;
        padding: 10px 15px;
        text-align: center;
        background-color: #f8f9fa;
        border-radius: 0 0 15px 15px;
        text-decoration: none;
        transition: all 0.3s ease-in-out;
    }

    .performance-card a:hover {
        background-color: #007bff;
        color: #fff;
    }
</style>
@endsection

@section('content')
<div class="container">
    <h2 class="mb-4">Academic Performances</h2>

    @if($performances->isEmpty())
        <div class="alert alert-warning">No academic performances available at the moment.</div>
    @else
        <div class="row">
            @foreach($performances as $performance)
                <div class="col-md-4 mb-4">
                    <div class="performance-card">
                        <!-- Image Section -->
                        @if($performance->image_url)
                            <img src="{{ $performance->image_url }}" alt="{{ $performance->student_name }}">
                        @else
                            <img src="https://via.placeholder.com/300x200" alt="No Image Available">
                        @endif

                        <!-- Icon Overlay -->
                        <div class="icon-overlay">
                            <i class="fas fa-graduation-cap"></i>
                        </div>

                        <!-- Content Section -->
                        <h5>{{ $performance->student_name }}</h5>
                        <p><strong>Class:</strong> {{ $performance->class }}</p>
                        <p><strong>Roll Number:</strong> {{ $performance->roll_number }}</p>
                        <p><strong>Term:</strong> {{ $performance->term }}</p>
                        <p><strong>Year:</strong> {{ $performance->year }}</p>
                        <p><strong>Grade:</strong> {{ $performance->grade }}</p>

                        <!-- View Details Button -->
                        <a href="{{ route('frontend.academic_performances.show', $performance->id) }}" class="view-details-btn">
                            <i class="fas fa-eye"></i> View Details
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
