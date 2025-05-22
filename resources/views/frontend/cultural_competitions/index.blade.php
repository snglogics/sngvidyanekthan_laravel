@extends('layouts.layout')

@section('title', 'Cultural Competitions')

@section('styles')
<style>
    /* Parallax background */
    .parallax-section {
        background-image: url('{{ asset('frontend/images/parallel7.jpg') }}');
        background-attachment: fixed;
        background-size: cover;
        background-position: center;
        padding: 100px 0 60px;
        position: relative;
        z-index: 1;
    }

    .parallax-section::before {
        content: "";
        position: absolute;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.4);
        z-index: -1;
    }

    .competitions-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
        margin-top: 30px;
        z-index: 2;
        position: relative;
    }

    .competition-card {
        background: linear-gradient(145deg, #ffffff, #f0f0f0);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        position: relative;
        cursor: pointer;
    }

    .competition-card img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        border-radius: 20px 20px 0 0;
        transition: transform 0.3s ease;
    }

    .competition-card:hover img {
        transform: scale(1.05);
    }

    .competition-card h3 {
        font-size: 22px;
        color: #007bff;
        margin: 20px 15px 5px;
        text-align: center;
    }

    .competition-card p {
        color: #666;
        font-size: 17px;
        margin: 0 15px 15px;
        text-align: center;
    }

    .competition-card .icon-overlay {
        position: absolute;
        top: 15px;
        left: 15px;
        background-color: #007bff;
        color: #fff;
        border-radius: 50%;
        width: 55px;
        height: 55px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, background-color 0.3s ease;
        z-index: 2;
    }

    .competition-card .icon-overlay:hover {
        background-color: #0056b3;
        transform: rotate(360deg);
    }

    .competition-card a {
        display: block;
        text-align: center;
        padding: 12px 0;
        font-weight: 600;
        color: #007bff;
        background-color: #f8f9fa;
        text-decoration: none;
        font-size: 16px;
        border-top: 1px solid #ddd;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .competition-card a:hover {
        background-color: #007bff;
        color: #fff;
    }

    @media (max-width: 768px) {
        .parallax-section {
            padding: 60px 0;
        }

        .competition-card h3 {
            font-size: 20px;
        }

        .competition-card p {
            font-size: 15px;
        }
    }
</style>
@endsection

@section('hero_title', 'Cultural Competitions')

@section('content')
<div class="parallax-section">
    <div class="container">
        <div class="competitions-container">
            @foreach($competitions as $competition)
                <div class="competition-card" data-aos="zoom-in">
                    @if($competition->image_url)
                        <img src="{{ $competition->image_url }}" alt="{{ $competition->title }}">
                    @else
                        <img src="https://via.placeholder.com/320x220" alt="No Image Available">
                    @endif
                    <div class="icon-overlay">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3>{{ $competition->title }}</h3>
                    <p><i class="fas fa-calendar-alt"></i> {{ $competition->competition_year }}</p>
                    <a href="{{ route('frontend.cultural_competitions.show', $competition->id) }}">
                        View Details <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- AOS Scroll Animation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true,
    });
</script>
@endsection
