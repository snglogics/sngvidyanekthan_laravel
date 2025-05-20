@extends('layouts.layout')

@section('title', 'Campus Overview')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet" />
<style>
    .campus-section {
        background: url('/frontend/images/campusImg.jpg') center/cover no-repeat;
        padding: 80px 0;
        position: relative;
    }

    .campus-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background: rgba(0, 0, 0, 0.6); /* dark overlay */
        z-index: 1;
    }

    .campus-section .container {
        position: relative;
        z-index: 2;
    }

    .campus-title {
        color: #fff;
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 50px;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.8);
    }

    .campus-card {
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .campus-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
    }

    .campus-card img {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }

    .campus-card-body {
        padding: 20px;
        flex-grow: 1;
    }

    .campus-card-title {
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 10px;
        color: #333;
    }

    .campus-card-description {
        font-size: 0.95rem;
        color: #666;
    }

    @media (max-width: 768px) {
        .campus-title {
            font-size: 2rem;
        }
    }
</style>
@endsection

@section('content')
<div class="campus-section">
    <div class="container">
        <h2 class="text-center campus-title" data-aos="fade-down">Campus Overviewsss</h2>
        <div class="row g-4">
            @foreach($campusOverviews as $overview)
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="campus-card h-100">
                        <img src="{{ $overview->main_image_url }}" alt="{{ $overview->main_heading }}">
                        <div class="campus-card-body">
                            <h4 class="campus-card-title">{{ $overview->main_heading }}</h4>
                            <p class="campus-card-description">{{ $overview->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
</script>
@endsection
