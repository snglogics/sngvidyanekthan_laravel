@extends('layouts.layout')

@section('title', 'House Life')

@section('content')
<!-- House Life Section -->
<div class="house-life-section">
    <div class="houselifecontainer">
        <!-- Title Section -->
        <h2 class="houselifetitle" data-aos="fade-up">
            <span class="highlight">House</span> Life
        </h2>

        <!-- Introduction Section -->
        <div class="intro-text" data-aos="fade-up" data-aos-delay="100">
            <p class="hourselifetext">
                House life plays a crucial role in fostering a sense of belonging, teamwork, and leadership among students. It encourages healthy competition, builds lifelong friendships, and develops important life skills such as collaboration, communication, and sportsmanship.
            </p>
        </div>

        <!-- House Cards Section -->
        <div class="house-cards">
            <!-- House 1 -->
            <div class="house-card" data-aos="fade-up">
                <img src="{{ asset('frontend/images/redhouse.jpg') }}" alt="Red House">
                <div class="house-info">
                    <h3>Red House</h3>
                    <p>Known for its courage and determination, the Red House inspires students to rise above challenges and strive for excellence in every field.</p>
                </div>
            </div>

            <!-- House 2 -->
            <div class="house-card" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('frontend/images/bkuehouse.jpg') }}" alt="Blue House">
                <div class="house-info">
                    <h3>Blue House</h3>
                    <p>With a spirit of perseverance and unity, the Blue House encourages students to work together towards common goals and achieve greatness.</p>
                </div>
            </div>

            <!-- House 3 -->
            <div class="house-card" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('frontend/images/greenhouse.jpg') }}" alt="Green House">
                <div class="house-info">
                    <h3>Green House</h3>
                    <p>Symbolizing growth and harmony, the Green House promotes environmental awareness and inspires students to lead by example.</p>
                </div>
            </div>

            <!-- House 4 -->
            <div class="house-card" data-aos="fade-up" data-aos-delay="300">
                <img src="{{ asset('frontend/images/yellowhouse.jpg') }}" alt="Yellow House">
                <div class="house-info">
                    <h3 class="houselifeheader">Yellow House</h3>
                    <p>Bright and vibrant, the Yellow House encourages creativity, positivity, and innovation among its members.</p>
                </div>
            </div>
        </div>

        <!-- Mission Section -->
        <div class="mission-section" data-aos="fade-up" data-aos-delay="400">
            <h3>Our Mission</h3>
            <p>
                Our house system aims to nurture leadership, encourage teamwork, and foster a sense of belonging. It provides a platform for students to excel in academics, sports, and cultural activities, while building lasting bonds and memories.
            </p>
        </div>
    </div>
</div>
@endsection
