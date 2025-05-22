@extends('layouts.layout')

@section('title', 'Club Activities')

@section('styles')
<style>
    .parallax-section {
        position: relative;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-shadow: 0px 0px 10px rgba(0,0,0,0.6);
        font-size: 2rem;
        text-align: center;
        padding: 0 1rem;
    }

    .parallax-1 {
        background-image: url('/frontend/images/club/club8.jpg');
    }

    .parallax-2 {
        background-image: url('/frontend/images/club/club9.jpg');
    }

    .parallax-3 {
        background-image: url('/frontend/images/club/club7.jpg');
    }
</style>
@endsection

@section('hero_title', 'Club Activities')

@section('content')
<!-- Club Activities Section -->
<div class="house-life-section">
    <div class="houselifecontainer">
        <!-- Introduction Section -->
        <div class="intro-text" data-aos="fade-up" data-aos-delay="100">
            <p class="hourselifetext">
                School clubs play a vital role in shaping well-rounded students by encouraging participation in extracurricular activities. From arts and culture to science and community service, clubs offer a space for creativity, collaboration, leadership, and personal growth.
            </p>
        </div>

        <!-- Parallax Section 1 -->
        <div class="parallax-section parallax-1">
            <div>Explore Your Passion</div>
        </div>

        <!-- Club Cards Section -->
        <div class="house-cards">
            <!-- Club 1 -->
            <div class="house-card" data-aos="fade-up">
                <img src="{{ asset('frontend/images/club/club6.jpg') }}" alt="Science Club">
                <div class="house-info">
                    <h3>Science Club</h3>
                    <p>Fueling curiosity through experiments, exhibitions, and innovation, the Science Club inspires young minds to explore and question the world around them.</p>
                </div>
            </div>

            <!-- Club 2 -->
            <div class="house-card" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('frontend/images/club/club5.jpg') }}" alt="Literary Club">
                <div class="house-info">
                    <h3>Literary Club</h3>
                    <p>Enhancing language and communication skills through debates, creative writing, and elocution, this club nurtures expression and storytelling.</p>
                </div>
            </div>

            <!-- Club 3 -->
            <div class="house-card" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('frontend/images/club/club4.jpg') }}" alt="Eco Club">
                <div class="house-info">
                    <h3>Eco Club</h3>
                    <p>Promoting environmental awareness and sustainable practices, the Eco Club motivates students to be responsible caretakers of our planet.</p>
                </div>
            </div>

            <!-- Club 4 -->
            <div class="house-card" data-aos="fade-up" data-aos-delay="300">
                <img src="{{ asset('frontend/images/club/club3.jpg') }}" alt="Art & Culture Club">
                <div class="house-info">
                    <h3>Art & Culture Club</h3>
                    <p>Celebrating creativity through dance, music, painting, and drama, this club allows students to express themselves artistically and culturally.</p>
                </div>
            </div>
        </div>

        <!-- Parallax Section 2 -->
        <div class="parallax-section parallax-2">
            <div>Discover Your Potential</div>
        </div>

        <!-- Mission Section -->
        <div class="mission-section" data-aos="fade-up" data-aos-delay="400">
            <h3>Our Vision</h3>
            <p class="hourselifetext">
                Our clubs aim to foster talent, promote teamwork, and develop leadership qualities in students. They provide a vibrant platform for young learners to explore their interests, serve the community, and grow beyond the classroom.
            </p>
        </div>

        <!-- Parallax Section 3 -->
        <div class="parallax-section parallax-3">
            <div>Learn Beyond the Classroom</div>
        </div>
    </div>
</div>
@endsection
