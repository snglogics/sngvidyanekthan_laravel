@extends('layouts.layout')

@section('title', 'Sports Award Details')

@section('styles')
<style>
    /* Parallax background */
    .parallax-section {
        background-image: url('{{ asset('/frontend/images/parallel6.jpg') }}');
        background-attachment: fixed;
        background-size: cover;
        background-position: center;
        padding: 100px 0;
    }

    .award-details-container {
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        padding: 40px 30px;
        margin: auto;
        max-width: 900px;
        position: relative;
        text-align: center;
        overflow: hidden;
    }

    .award-details-container img {
        width: 100%;
        max-width: 600px;
        border-radius: 20px;
        margin: 30px 0;
        transition: all 0.3s ease-in-out;
    }

    .award-details-container img:hover {
        transform: scale(1.05);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }

    .award-title {
        color: #007bff;
        font-weight: bold;
        font-size: 34px;
        margin-top: 30px;
    }

    .award-year {
        color: #f39c12;
        font-weight: bold;
        font-size: 24px;
        margin-bottom: 25px;
    }

    .award-description {
        color: #333;
        font-size: 18px;
        line-height: 1.8;
        padding: 0 20px;
        text-align: justify;
    }

    .back-btn {
        background-color: #007bff;
        color: #fff;
        padding: 14px 35px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: background-color 0.3s ease;
        display: inline-block;
        margin-top: 30px;
        font-size: 18px;
    }

    .back-btn:hover {
        background-color: #0056b3;
    }

    .icon-overlay {
        position: absolute;
        top: -45px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #007bff;
        color: #fff;
        border-radius: 50%;
        width: 90px;
        height: 90px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        z-index: 10;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        transition: all 0.3s ease-in-out;
    }

    .icon-overlay:hover {
        background-color: #0056b3;
        transform: translateX(-50%) rotate(360deg);
    }

    .details-box {
        background-color: #f9f9f9;
        padding: 25px;
        border-radius: 15px;
        margin-top: 20px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .details-box h4 {
        color: #007bff;
        margin-bottom: 15px;
        font-size: 20px;
    }

    .details-box p {
        color: #555;
        font-size: 17px;
        margin: 0;
    }
</style>
@endsection
@section('hero_title', '🏆 Sports Awards')
@section('content')
<div class="parallax-section">
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
                <img src="https://via.placeholder.com/600x400" alt="No Image Available">
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
</div>

<!-- AOS Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true,
    });
</script>
@endsection
