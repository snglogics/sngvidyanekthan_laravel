@extends('layouts.layout')

@section('title', 'Vision, Mission & Core Values')

@section('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
    .info-section {
        background-size: cover;
        background-position: center;
        border-radius: 16px;
        padding: 2rem;
        position: relative;
        overflow: hidden;
        min-height: 380px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #fff;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    }

    .info-section::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(5px);
        z-index: 0;
    }

    .info-section > div {
        position: relative;
        z-index: 1;
    }

    .info-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: #00d1b2;
    }

    .info-section h3 {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .info-section p {
        font-size: 1.05rem;
        line-height: 1.6;
        font-weight: 300;
    }

    @media (max-width: 768px) {
        .info-section {
            padding: 1.5rem;
        }

        .info-section h3 {
            font-size: 1.5rem;
        }

        .info-section p {
            font-size: 0.95rem;
        }
    }
</style>
@endsection
@section('hero_title', 'Vision, Mission & Core Values')
@section('content')
<section class="py-5" style="background: #f0f2f5;">
    <div class="container">
        

        <div class="row g-4">
            <!-- Vision -->
            <div class="col-lg-4" data-aos="fade-up">
                <div class="info-section" style="background-image: url('{{ asset('frontend/images/vision.jpg') }}');">
                    <div>
                        <div class="info-icon"><i class="fas fa-eye"></i></div>
                        <h3>Our Vision</h3>
                        <p>To empower every student to reach their full potential and become visionary leaders with a strong moral compass, a sense of purpose, and a passion to serve humanity. We encourage students to <strong>Dream, Believe, Achieve, and Lead</strong> with courage and compassion.</p>
                    </div>
                </div>
            </div>

            <!-- Mission -->
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="150">
                <div class="info-section" style="background-image: url('{{ asset('frontend/images/mission.jpg') }}');">
                    <div>
                        <div class="info-icon"><i class="fas fa-bullseye"></i></div>
                        <h3>Our Mission</h3>
                        <p>We strive to create a nurturing and inclusive environment where students grow intellectually, emotionally, and socially. Our mission is to foster curiosity, resilience, and a lifelong love for learning in every child — preparing them to navigate and shape a dynamic world.</p>
                    </div>
                </div>
            </div>

            <!-- Core Values -->
            <!-- <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="info-section" style="background-image: url('{{ asset('frontend/images/values.jpg') }}');">
                    <div>
                        <div class="info-icon"><i class="fas fa-heart"></i></div>
                        <h3>Core Values</h3>
                        <p>Our core values — <strong>Integrity, Compassion, Excellence, Equality</strong>, and <strong>Responsibility</strong> — serve as guiding principles in our journey. These values are woven into the fabric of our school culture, shaping learners who make meaningful contributions to the world.</p>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true
    });
</script>
@endsection
