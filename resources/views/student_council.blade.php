@extends('layouts.layout')

@section('title', 'Student Council')
@section('hero_title', 'Student Council')

@section('styles')
<style>
    .student-council-section {
        overflow: hidden;
    }

    .council-parallax-section {
        position: relative;
        background-attachment: fixed;
        background-size: cover;
        background-position: center;
        color: white;
        padding: 80px 20px;
    }

    .councilcontainer {
        max-width: 1200px;
        margin: auto;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Dark overlay for readability */
        z-index: 1;
    }

    .council-content {
        position: relative;
        z-index: 2;
    }

    .counciltitle {
        font-size: 40px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 30px;
    }

    .councldescription,
    .council-text {
        font-size: 18px;
        line-height: 1.6;
        max-width: 800px;
        margin: auto;
        text-align: center;
    }

    .council-row {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }

    .cta-section {
        text-align: center;
        margin-top: 40px;
    }

    .cta-button {
        display: inline-block;
        padding: 12px 30px;
        background-color: #f39c12;
        color: white;
        border-radius: 6px;
        text-decoration: none;
        font-weight: bold;
        transition: 0.3s ease;
    }

    .cta-button:hover {
        background-color: #d35400;
    }

    @media (min-width: 768px) {
        .council-row {
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }

        .council-text {
            max-width: 50%;
            text-align: left;
        }
    }
</style>
@endsection

@section('content')
<div class="student-council-section">

    <!-- Introduction Section -->
    <div class="council-parallax-section" style="background-image: url('/frontend/images/laravell8.jpg');">
        
        <div class="councilcontainer council-content" data-aos="fade-up">
            
            <div class="councldescription">
                <p>
                    The Student Council plays a vital role in shaping the student experience, fostering leadership skills, and building a strong sense of community. It empowers students to voice their opinions, organize meaningful activities, and take on leadership roles.
                </p>
                <p>
                    Through the Student Council, students learn the importance of responsibility, collaboration, and effective communication, preparing them for future success as active citizens and leaders.
                </p>
            </div>
        </div>
    </div>

    <!-- Future Benefits Section -->
    <div class="council-parallax-section" style="background-image: url('{{ asset('frontend/images/consil.jpg') }}');">
        <div class="overlay"></div>
        <div class="councilcontainer council-content" data-aos="fade-up">
            <div class="council-row">
                <div class="council-text">
                    <h3>Future Benefits of Joining the Council</h3>
                    <p class="council-paragraph">
                        Being part of the student council is an excellent way to develop leadership skills, improve communication abilities, and gain valuable experience in organizing events and managing teams. It helps build confidence and prepares students for future roles in college and careers.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Who Needs a Council Section -->
    <div class="council-parallax-section" style="background-image: url('{{ asset('frontend/images/cousil2.jpg') }}');">
        <div class="overlay"></div>
        <div class="councilcontainer council-content" data-aos="fade-up" data-aos-delay="100">
            <div class="council-row reverse">
                <div class="council-text">
                    <h3>Who Needs a Student Council?</h3>
                    <p class="council-paragraph">
                        Every student can benefit from the opportunities provided by a student council. It's essential for those who want to take on leadership roles, positively impact their school, and build skills needed for personal and professional success.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Mission and Vision Section -->
    <div class="council-parallax-section" style="background-image: url('{{ asset('frontend/images/council3.jpg') }}');">
        <div class="overlay"></div>
        <div class="councilcontainer council-content" data-aos="fade-up" data-aos-delay="200">
            <div class="council-row">
                <div class="council-text">
                    <h3>Our Mission and Vision</h3>
                    <p class="council-paragraph">
                        The Student Council aims to foster leadership, community, and responsibility among students. We strive to create a positive school environment, promote student welfare, and represent the student voice in decision-making.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action Section -->
    <div class="cta-section" data-aos="zoom-in" data-aos-delay="300">
        <a href="{{ route('contact')}}" class="cta-button">Join the Council</a>
    </div>

</div>
@endsection
