@extends('layouts.layout')

@section('title', 'Sports Award Details')

@section('styles')
<style>
    .award-details-container {
        background-color: #ffffff;
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        padding: 30px;
        margin-bottom: 30px;
        position: relative;
        text-align: center;
    }

    .award-details-container img {
        width: 100%;
        max-width: 500px;
        border-radius: 20px;
        margin-bottom: 20px;
        transition: all 0.3s ease-in-out;
    }

    .award-details-container img:hover {
        transform: scale(1.05);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }

    .award-title {
        color: #007bff;
        font-weight: bold;
        margin-bottom: 20px;
        font-size: 28px;
    }

    .award-year {
        color: #f39c12;
        font-weight: bold;
        margin-bottom: 20px;
        font-size: 22px;
    }

    .award-description {
        color: #555;
        font-size: 18px;
        margin-bottom: 20px;
        line-height: 1.6;
        padding: 0 15px;
        text-align: justify;
    }

    .back-btn {
        background-color: #007bff;
        color: #fff;
        padding: 12px 30px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
        display: inline-block;
        margin-bottom: 15px;
        font-size: 18px;
    }

    .back-btn:hover {
        background-color: #0056b3;
        text-decoration: none;
    }

    .icon-overlay {
        position: absolute;
        top: -40px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #007bff;
        color: #fff;
        border-radius: 50%;
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        z-index: 10;
        transition: all 0.3s ease-in-out;
    }

    .icon-overlay:hover {
        background-color: #0056b3;
        transform: translateX(-50%) rotate(360deg);
    }

    .details-box {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 15px;
        margin-bottom: 20px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .details-box h4 {
        color: #007bff;
        margin-bottom: 10px;
    }

    .details-box p {
        color: #555;
        font-size: 16px;
        margin: 0;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="award-details-container" data-aos="fade-up">
        <!-- Icon Overlay -->
        <div class="icon-overlay">
            <i class="fas fa-trophy"></i>
        </div>

        <!-- Image Section -->
        @if($sportsAward->image_url)
            <img src="{{ $sportsAward->image_url }}" alt="{{ $sportsAward->title }}">
        @else
            <img src="https://via.placeholder.com/500" alt="No Image Available">
        @endif

        <!-- Title and Year -->
        <h2 class="award-title">{{ $sportsAward->title }}</h2>
        <h3 class="award-year"><i class="fas fa-calendar-alt"></i> {{ $sportsAward->award_year }}</h3>

        <!-- Description Section -->
        <div class="details-box">
            <h4>Description</h4>
            <p>{{ $sportsAward->description ?? 'No description available.' }}</p>
        </div>

        <!-- Back Button -->
        <a href="{{ route('frontend.sports_awards.index') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Awards
        </a>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true,
    });
</script>

@endsection
