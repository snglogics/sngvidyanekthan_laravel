@extends('layouts.layout')

@section('title', 'Vision, Mission & Core Values')



@section('content')
<section class="py-5" style="background: #f9f9f9;">
    <div class="container">
        <h2 class="text-center text-primary  fw-bold mb-5" data-aos="fade-down">Vision, Mission & Core Values</h2>

        <div class="row">
            <div class="col-lg-4" data-aos="zoom-in-up">
                <div class="info-section" style="background-image: url('{{ asset('frontend/images/vision.jpg') }}');">
                <div>
    <div class="info-icon"><i class="fas fa-eye"></i></div>
    <h3>Our Vision</h3>
    <p>Achieving freedom through education upholding the core human values with global perspective. We nurture young minds to <strong>Dream, Believe, Achieve and Lead</strong>.</p>
</div>

                </div>
            </div>

            <div class="col-lg-4" data-aos="zoom-in-up" data-aos-delay="100">
                <div class="info-section" style="background-image: url('{{ asset('frontend/images/mission.jpg') }}');">
                    
                    <div>
    <div class="info-icon"><i class="fas fa-bullseye"></i></div>
    <h3>Our Mission</h3>
    <p>We aim to develop confident, smart individuals with survival skills in this ever-changing world, fostering a spirit of enquiry, lifelong learning, and environmental consciousness.</strong>.</p>
</div>

                </div>
            </div>

            <div class="col-lg-4" data-aos="zoom-in-up" data-aos-delay="200">
                <div class="info-section" style="background-image: url('{{ asset('frontend/images/values.jpg') }}');">
                    
                    <div>
                <div class="info-icon"><i class="fas fa-heart"></i></div>
                <h3>Core Values</h3>
                <p>Integrity, Compassion, Excellence, Equality, and Responsibility — values that shape every learner to be a positive contributor to society.</p>
                </div>

                </div>
            </div>
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
