@extends('layouts.layout')

@section('title', 'Student Council')

@section('content')
<!-- Student Council Section -->
<div class="student-council-section">
    <div class="councilcontainer">
        <!-- Title Section -->
        <h2 class="counciltitle" data-aos="fade-up">
            <span class="highlight">Student</span> Council
        </h2>

        <!-- Importance of Student Council -->
        <div class="councldescription" data-aos="fade-up" data-aos-delay="100">
            <p>
                The Student Council plays a vital role in shaping the student experience, fostering leadership skills, and building a strong sense of community. It empowers students to voice their opinions, organize meaningful activities, and take on leadership roles. Through the Student Council, students learn the importance of responsibility, collaboration, and effective communication, preparing them for future success as active citizens and leaders.
            </p>
        </div>

        <!-- Council Members and councldescription Section -->
        <div class="council-section">
            <!-- First Block (Image Left, Text Right) -->
            <div class="council-row" data-aos="fade-up">
                <img src="{{ asset('frontend/images/consil.jpg') }}" class="council-image" alt="Council Member 1">
                <div class="council-text">
                    <h3>Future Benefits of Joining the Council</h3>
                    <p class="council-paragraph">
                        Being part of the student council is an excellent way to develop leadership skills, improve communication abilities, and gain valuable experience in organizing events and managing teams. It helps build confidence, enhances problem-solving skills, and prepares students for future roles in college and careers.
                    </p>
                </div>
            </div>

            <!-- Second Block (Text Left, Image Right) -->
            <div class="council-row reverse" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('frontend/images/cousil2.jpg') }}" class="council-image" alt="Council Member 2">
                <div class="council-text">
                    <h3>Who Needs a Student Council?</h3>
                    <p class="council-paragraph">
                        Every student can benefit from the opportunities provided by a student council. It is especially important for those who want to take on leadership roles, make a positive impact on their school, and develop the skills needed for personal and professional success.
                    </p>
                </div>
            </div>

            <!-- Third Block (Image Left, Text Right) -->
            <div class="council-row" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('frontend/images/council3.jpg') }}" class="council-image" alt="Council Member 3">
                <div class="council-text">
                    <h3>Our Mission and Vision</h3>
                    <p class="council-paragraph">
                        The Student Council aims to foster leadership, community, and responsibility among students. We strive to create a positive school environment, promote student welfare, and represent the student voice in school decision-making processes.
                    </p>
                </div>
            </div>
        </div>

        <!-- Call to Action Section -->
        <div class="cta-section" data-aos="zoom-in" data-aos-delay="300">
            <a href="{{ route('contact')}}" class="cta-button">
                Join the Council
            </a>
        </div>
    </div>
</div>
@endsection
