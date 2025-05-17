@extends('layouts.layout')

@section('title', 'Our Teachers')

@section('styles')
<style>
    .teacher-list-container {
        background-color: #f8f9fa;
        padding: 50px 0;
    }

    .teacher-card {
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: all 0.3s ease-in-out;
        display: flex;
        flex-direction: row;
        margin-bottom: 30px;
        width: 100%;
        max-width: 900px;
        margin: 15px auto;
    }

    .teacher-card img {
        width: 250px;
        height: 250px;
        border-radius: 15px 0 0 15px;
        object-fit: cover;
        transition: all 0.3s ease-in-out;
    }

    .teacher-card img:hover {
        transform: scale(1.05);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }

    .teacher-card .card-body {
        padding: 20px;
        flex: 1;
    }

    .teacher-card .card-body h3 {
        color: #007bff;
        font-weight: bold;
        margin-bottom: 10px;
        font-size: 24px;
    }

    .teacher-card .card-body h5 {
        color: #555;
        font-weight: bold;
        margin-bottom: 10px;
        font-size: 18px;
    }

    .teacher-card .card-body p {
        color: #777;
        font-size: 16px;
        margin-bottom: 15px;
    }

    .teacher-card .details-list {
        list-style-type: none;
        padding: 0;
        margin-bottom: 20px;
    }

    .teacher-card .details-list li {
        margin-bottom: 8px;
        font-size: 14px;
        color: #555;
        display: flex;
        align-items: center;
    }

    .teacher-card .details-list li i {
        color: #007bff;
        margin-right: 15px;
        font-size: 20px;
    }

    .teacher-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }

    .teacher-card .view-profile-btn {
        background-color: #007bff;
        color: #fff;
        padding: 10px 30px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
        display: inline-block;
        margin-top: 15px;
        font-size: 16px;
    }

    .teacher-card .view-profile-btn:hover {
        background-color: #0056b3;
        text-decoration: none;
    }

    @media (min-width: 992px) {
        .teacher-card-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .teacher-card {
            flex: 0 0 calc(50% - 20px);
            max-width: calc(50% - 20px);
        }
    }
</style>
@endsection

@section('content')
<section class="teacher-list-container">
    <div class="container">
        <h2 class="text-center text-primary fw-bold mb-5" data-aos="fade-down">Meet Our Teachers</h2>

        <div class="teacher-card-wrapper">
            @foreach($teachers as $teacher)
            <div class="teacher-card" data-aos="fade-up">
                <img src="{{ $teacher->photo }}" alt="{{ $teacher->name }}">
                <div class="card-body">
                    <h3>{{ $teacher->name }}</h3>
                    <h5>{{ $teacher->designation }}</h5>
                    <ul class="details-list">
                        <li><i class="fas fa-briefcase"></i> <strong>Experience:</strong> {{ $teacher->experience }} years</li>
                        <li><i class="fas fa-graduation-cap"></i> <strong>Qualification:</strong> {{ $teacher->qualification }}</li>
                        <li><i class="fas fa-chalkboard-teacher"></i> <strong>Department:</strong> {{ $teacher->department }}</li>
                        <li><i class="fas fa-book"></i> <strong>Subject:</strong> {{ $teacher->subject }}</li>
                    </ul>
                    <!-- <a href="#" class="view-profile-btn">
                        <i class="fas fa-eye"></i> View Profile
                    </a> -->
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
</script>
@endsection
