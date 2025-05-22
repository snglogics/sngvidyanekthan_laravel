@extends('layouts.layout')

@section('title', 'Co-Curricular Programs')
@section('hero_title', 'Our Co-Curricular Programs')

@section('styles')
<style>
    .programs-container {
        background-image: url('/frontend/images/parallel19.jpg');
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
        padding: 60px 0;
    }

    .card {
        background-color: rgba(255, 255, 255, 0.25)  !important;
        backdrop-filter: blur(8px);
        transition: transform 0.3s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-title {
        font-weight: 700;
        font-size: 1.25rem;
    }

    .card-text {
        font-size: 0.95rem;
    }
</style>
@endsection

@section('content')
<section class="programs-container">
    <div class="container py-5">
        <div class="row">
            @foreach($programs as $program)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-lg rounded-4 border-0">
                    @if($program->image_url)
                        <img src="{{ $program->image_url }}" class="card-img-top rounded-top-4" alt="{{ $program->name }}" style="height: 250px; object-fit: cover;">
                    @else
                        <div class="card-img-top rounded-top-4 bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 250px;">
                            No Image
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $program->name }}</h5>
                        <p class="card-subtitle mb-2 text-muted">{{ $program->category }}</p>
                        <p class="card-text">{{ Str::limit($program->description, 100) }}</p>
                        <a href="{{ route('frontend.co_curricular_programs.show', $program->id) }}" class="btn btn-primary btn-sm w-100">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
