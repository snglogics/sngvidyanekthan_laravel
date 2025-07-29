@extends('layouts.layout')
@section('content')




    <style>

        .bg_cover {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    /* margin: 2px; */
}
        #category-part {
            background-color: #ffffff;
            padding: 80px 0;
        }

        #category-part h2 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-align: left;
        }

        #category-part h2 span {
            color: #0f64af;
        }


        #category-part p.section-description {
            color: #555;
            font-size: 1.15rem;
            line-height: 1.8;
            margin-bottom: 40px;
            text-align: left;
        }

        .facility-card {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 30px 20px;
            text-align: center;
            transition: all 0.4s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* max-width: 250px; */
            margin: 0 auto;
        }

        .facility-card:hover {
            background-color: #0f64af;
            color: #ffffff;
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(15, 100, 175, 0.2);
        }

        .facility-card i {
            font-size: 2rem;
            color: #0f64af;
            margin-bottom: 15px;
            transition: all 0.4s ease;
        }

        .facility-card:hover i {
            color: #ffffff;
            transform: scale(1.15) rotate(5deg);
        }

        .facility-card strong {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 10px;
            transition: all 0.4s ease;
        }

        .facility-card p {
            color: #777;
            margin: 0;
            font-size: 0.9rem;
            transition: all 0.4s ease;
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .facility-card:hover strong,
        .facility-card:hover p {
            color: #ffffff;
        }

        .row.equal-height>[class*='col-'] {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .left-section {
            padding-right: 40px;
            /* border-right: 2px solid #f3f4f6; */
            margin-bottom: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start !important;
        }



        /* Priciple  Message*/
        .principal-section.container {
            padding: 80px 20px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 40px;
            /* background-color: #f9f9f9; */
            /* box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05); */

        }

        .principal-quote-container {
            flex: 1;
            margin: 0 auto;
            text-align: center;
            padding: 40px 30px;
            background-color: #ffffff;
            border-radius: 20px;
            position: relative;
        }

        .principal-quote-container::before {
            content: '“';
            font-size: 80px;
            color: #0f64af;
            position: absolute;
            top: -40px;
            left: 20px;
            opacity: 0.2;
            z-index: 0;
        }

        .principal-quote-container::after {
            content: '”';
            font-size: 80px;
            color: #0f64af;
            position: absolute;
            bottom: -40px;
            right: 20px;
            opacity: 0.2;
            z-index: 0;
        }

        .principal-quote {
            font-size: 1rem;
            color: #555;
            line-height: 1.8;
            z-index: 1;
            position: relative;
            text-align: center;
            padding: 0 20px;
            margin-top: 16px;
        }

        .principal-name {
            font-size: 1.5rem;
            color: #0f64af;
            font-weight: 700;
            margin-top: 20px;
            position: relative;
            z-index: 1;
        }

        .principal-image-container img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            /* margin-bottom: 15px; */
            border: 5px solid #ffffff;
            /* box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15); */
            z-index: 1;
            position: relative;
        }


        /* Events */
        .event-section {
            /* margin-bottom: 80px; */
            padding: 60px 30px;
        }

        .event-section:nth-of-type(odd) {
            background-color: #f9f9f9;
            border-radius: 20px;
        }

        .event-section h3 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
            color: #0f64af;
            display: inline-block;
        }

        .event-carousel-container {
            position: relative;
            padding: 0 30px;
            overflow: hidden;
        }

        .event-carousel {
            display: flex;
            overflow-x: auto;
            scroll-behavior: smooth;
            gap: 8px;
            /* spacing between cards */
            padding-bottom: 8px;
            -webkit-overflow-scrolling: touch;
            /* optional for scrollbar padding */
        }

        .event-card {
            min-width: 250px;
            flex: 0 0 auto;
            margin-right: 16px;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
.image-wrapper {
    display: block;
    text-align: center;
    padding: 10px; /* optional, for spacing */
}

.image-wrapper img {
    max-width: 100%;
    height: auto;
    display: inline-block;
}
        .event-carousel::-webkit-scrollbar {
            display: none;
        }


        .event-card:hover {
            transform: translateY(-10px);
            border-color: #0f64af;
            box-shadow: 0 20px 40px rgba(15, 100, 175, 0.15);
        }


        .event-card img {
            width: 100%;
            height: 230px;
            object-fit: cover;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        .event-card .card-body {
            padding: 20px;
            text-align: center;
        }

        .event-card .card-title {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .event-card .card-text {
            color: #777;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        @media (max-width: 767px) {
            .event-section h3 {
                font-size: 1.5rem;
                /* adjust as needed */
            }
        }

        /* Small screen (mobile) styles */
        @media (max-width: 767px) {
            .event-card {
                width: 60vw;
                /* full viewport width */
                scroll-snap-align: start;
                /* snap to start of card */
            }

            .event-carousel {
                scroll-snap-type: x mandatory;
            }
        }

        .scroll-btn {
            position: absolute;
            top: 50%;
            /* transform: translateY(-50%); */
            background-color: #ffffff;
            border: none;
            color: #0f64af;
            font-size: 1.5rem;
            padding: 12px 18px;
            border-radius: 50%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            z-index: 2;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        

        /* .scroll-btn i {
            font-size: 1.25rem;
            transition: all 0.3s ease;
        } */

        .scroll-btn:hover {
            background-color: #0f64af;
            color: #ffffff;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .scroll-btn:hover i {
            transform: translateX(4px);
        }

       
   
        .scroll-btn.left {
            left: -0px;
        }

        .scroll-btn.right {
            right: -0px;
        }


        /* Quick stats */

        .stats-section {
            background: url('https://static.vecteezy.com/system/resources/thumbnails/027/100/132/small_2x/planning-for-a-mock-up-with-space-to-write-ideas-on-a-dark-green-background-back-to-school-banner-free-photo.jpg') center/cover no-repeat;
            padding: 100px 20px;
            color: #ffffff;
            position: relative;
            background-attachment: fixed;
        }

        .stats-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(15, 100, 175, 0.8);
            z-index: 0;
        }

        .stats-section .container {
            position: relative;
            z-index: 1;
        }

        .stat-card {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 40px 20px;
            text-align: center;
            transition: all 0.4s ease;
            border: 1px solid #e0e0e0;
            color: #0f64af;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .stat-card:hover {
            transform: translateY(-10px);
            background-color: #0f64af;
            color: #ffffff;
            border-color: #0f64af;
            box-shadow: 0 30px 70px rgba(15, 100, 175, 0.4);
        }

        .stat-card i {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #0f64af;
            transition: all 0.4s ease;
        }

        .stat-card:hover i {
            color: #ffffff;
            transform: scale(1.2);
        }

        .stat-card h2 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: #0f64af;
            transition: all 0.4s ease;
        }

        .stat-card p {
            font-size: 1.2rem;
            color: #555;
            transition: all 0.4s ease;
        }

        .stat-card:hover h2,
        .stat-card:hover p {
            color: #ffffff;
        }

        /* contact */
        #contact-section {
            padding: 80px 20px;
            background-color: #f9f9f9;
        }

        .contact-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .contact-header h2 {
            font-size: 3rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 15px;
        }

        .contact-header p {
            color: #777;
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
        }

        .contact-info {
            display: flex;
            gap: 30px;
            margin-bottom: 40px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .info-card {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            text-align: left;
            border: 1px solid #e0e0e0;
            flex: 1;
            max-width: 350px;
            transition: all 0.3s ease;
        }

        .info-card:hover {
            background-color: #f0f4f8;
            border-color: #0f64af;
            transform: translateY(-5px);
        }

        .info-card i {
            font-size: 2rem;
            color: #0f64af;
            margin-bottom: 15px;
        }

        .info-card h4 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 10px;
        }

        .info-card p {
            color: #777;
            font-size: 1rem;
        }

        .map-container {
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid #e0e0e0;
            margin-bottom: 40px;
        }

        .map-frame {
            width: 100%;
            height: 500px;
            border: none;
            border-radius: 15px;
        }

        .btn-get-directions {
            display: inline-block;
            background-color: #0f64af;
            color: #ffffff;
            padding: 15px 30px;
            border-radius: 30px;
            text-align: center;
            text-decoration: none;
            margin: 20px auto 0 auto;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-get-directions:hover {
            background-color: #084080;
        }

        .contact-form-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 15px;
            border: 1px solid #e0e0e0;
            margin-bottom: 40px;
        }

        .contact-form-container h3 {
            font-size: 2.2rem;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
            flex: 1;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 15px 20px 15px 50px;
            border-radius: 15px;
            background-color: #f0f4f8;
            border: none;
            font-size: 1rem;
            color: #555;
            outline: none;
        }

        .form-group i {
            position: absolute;
            top: 30px;
            left: 20px;
            transform: translateY(-50%);
            color: #888;
            font-size: 1.2rem;
        }

        .form-row {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .submit-btn {
            background-color: #0f64af;
            color: #ffffff;
            padding: 15px 30px;
            border-radius: 30px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .submit-btn:hover {
            background-color: #084080;
        }
.rotate-icon {
    transform: rotate(180deg); /* Rotates 180 degrees */
    transition: transform 0.3s ease; /* Smooth animation */
}
        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
            }

            .contact-header h2 {
                font-size: 2.5rem;
            }

            .contact-header p {
                font-size: 1rem;
            }
        }



        /*  */

        .why-choose-section {
            padding: 10px 20px;
            background-color: #ffffff;
        }

        .why-choose-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .why-choose-header h2 {
            font-size: 3rem;
            font-weight: 700;
            color: #000;
            margin-bottom: 20px;
        }

        @media (max-width: 767px) {
            .why-choose-header h2 {
                font-size: 1.5rem;
                /* smaller size on small screens */
            }
        }

        .why-card {
            background-color: #f5f7fa;
            padding: 40px 30px;
            border-radius: 15px;
            border: 1px solid #e0e0e0;
            text-align: left;
            transition: all 0.4s ease;
            height: 100%;
        }

        .why-card:hover {
            background-color: #f0f4f8;
            transform: translateY(-5px);
        }

        .why-card i {
            font-size: 2.5rem;
            color: #0f64af;
            margin-bottom: 20px;
        }

        .why-card h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: #333;
        }

        .why-card p {
            color: #777;
            font-size: 1rem;
            line-height: 1.8;
        }

        .icon-title-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            /* optional spacing between icon and text */
        }

        @media (max-width: 767px) {
            .icon-title-wrap {
                display: flex;
                align-items: center;
                gap: 8px;
                margin-bottom: 10px
                    /* spacing between icon and h3 */
            }

            .why-card i {
                font-size: 1.2rem;
                margin: 0
                    /* adjust as needed */
            }

            .why-card h3 {
                font-size: 1rem;
                /* adjust as needed */
                margin: 0;
                /* remove default margin */
            }
        }

        .cta-card {
            background-color: #0f64af;
            color: #ffffff;
            padding: 40px 30px;
            border-radius: 15px;
            text-align: left;
            border: none;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }

        .cta-card i {
            font-size: 2.5rem;
            color: #ffffff;
            margin-bottom: 20px;
        }

        .cta-card h3 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: #ffffff;
        }

        .cta-card p {
            color: #ffffff;
            font-size: 1rem;
            line-height: 1.8;
        }

        .cta-btn {
            background-color: #39d39f;
            color: #ffffff;
            padding: 15px 30px;
            border-radius: 30px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: fit-content;
        }

        .cta-btn:hover {
            background-color: #2fb682;
        }

        @media (max-width: 992px) {
            .cta-card {
                grid-row: span 1;
            }
        }

        .principal-name {
            font-size: 2rem;
            color: white;
            background: linear-gradient(to right, #00f, rgb(0, 255, 191));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shine 2s infinite linear;
        }

        @keyframes shine {
            from {
                background-position: 0%;
            }

            to {
                background-position: 100%;
            }
        }
    </style>
    <style>
        #notification-box {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            padding: 1rem;
            background: radial-gradient(ellipse at center, #0f2027, #203a43, #2c5364);
            opacity: 0.85;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.2);
            max-height: 300px;
            /* Set a maximum height */
            overflow-y: auto;
            /* Enable vertical scrolling */
        }

        /* Optional: Style the scrollbar */
        #notification-box::-webkit-scrollbar {
            width: 8px;
        }

        #notification-box::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        #notification-box::-webkit-scrollbar-thumb {
            background: rgba(0, 255, 255, 0.3);
            border-radius: 10px;
        }

        #notification-box::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 255, 255, 0.5);
        }

        .blinking-text {
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            padding: 16px;
            background: rgba(0, 255, 255, 0.05);
            color: #ffffff;
            font-weight: 500;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(6px);
            animation: pulseGlow 3s infinite ease-in-out;
            transition: transform 0.3s;
            flex-shrink: 0;
            /* Prevent items from shrinking */
        }

        .blinking-text:hover {
            transform: scale(1.02) rotateX(2deg);
            box-shadow: 0 0 25px rgba(0, 255, 255, 0.3);
        }

        .blinking-text strong {
            font-size: 1.2rem;
            color: #00ffff;
            text-shadow: 0 0 10px #00ffff, 0 0 20px #00ffff;
        }

        .blinking-text p {
            margin-top: 8px;
            color: #e0f7fa;
        }

        .blinking-text a {
            color: #00e6e6;
            text-shadow: 0 0 8px #00e6e6;
        }

        @keyframes pulseGlow {
            0% {
                box-shadow: 0 0 10px rgba(0, 255, 255, 0.1);
            }

            50% {
                box-shadow: 0 0 30px rgba(0, 255, 255, 0.3);
            }

            100% {
                box-shadow: 0 0 10px rgba(0, 255, 255, 0.1);
            }
        }
    </style>


    <div class="search-box">
        <div class="serach-form">
            <div class="closebtn">
                <span></span>
                <span></span>
            </div>
            <form action="#">
                <input type="text" placeholder="Search by keyword">
                <button><i class="fa fa-search"></i></button>
            </form>
        </div> <!-- serach form -->
    </div>

    <!--====== SEARCH BOX PART ENDS ======-->

    <!--====== SLIDER PART START ======-->

    <section id="slider-part" class="slider-active">


        @foreach ($sliders as $slider)
            <div class="single-slider bg_cover pt-150" style="background-image: url('{{ $slider['image_url'] }}') "
                data-overlay="4">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-7 col-lg-9">
                            <div class="slider-cont">
                                <h1 data-animation="bounceInLeft" data-delay="1s">{{ $slider['header'] ?? '' }}</h1>
                                <p data-animation="fadeInUp" data-delay="1.3s">
                                    {{ \Illuminate\Support\Str::limit($slider['common_header'] ?? '', 400, '...') }}</p>
                                <ul>
                                    <li><a data-animation="fadeInUp" data-delay="1.6s" class="main-btn"
                                            href="{{ route('slider') }}">Read More</a></li>
                                    <li><a data-animation="fadeInUp" data-delay="1.9s" class="main-btn main-btn-2"
                                            href="{{ route('contact') }}">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </section>

    <!--====== SLIDER PART ENDS ======-->

    <!--====== CATEGORY PART START ======-->

    {{-- <section id="category-part">
    <div class="container">
        <div class="category pt-40 pb-80">
            <div class="row">
                <div class="col-lg-4">
                    <div class="category-text pt-40">
                        <h2>Our Facilities</h2>
                        <p class="text-white" style="font-size: 14px; padding: 10px 0 10px 50px;">
                            We provide a wide range of facilities to ensure a holistic learning experience for our students.
                        </p>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="position-relative mt-40">
                        <div class="category-slied d-flex">
                            @foreach ([['icon' => 'laboratory.png', 'label' => 'Laboratories', 'color' => 'color-1'], ['icon' => 'sports.png', 'label' => 'Sport Facility', 'color' => 'color-2'], ['icon' => 'libraray.png', 'label' => 'Library', 'color' => 'color-3'], ['icon' => 'digitalClass.png', 'label' => 'Digital Class', 'color' => 'color-1'], ['icon' => 'canteen.png', 'label' => 'Canteen', 'color' => 'color-2'], ['icon' => 'auditorium.png', 'label' => 'Auditorium', 'color' => 'color-3']] as $item)
                            <div class="single-category text-center {{ $item['color'] }}" style="width: 250px;">
                                <a href="#">
                                    <span class="singel-category d-block p-3">
                                        <span class="icon mb-3 d-block">
                                            <img src="frontend/images/{{ $item['icon'] }}" alt="Icon" style="width: 80px;">
                                        </span>
                                        <span class="cont d-block">
                                            <strong>{{ $item['label'] }}</strong>
                                        </span>
                                    </span>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section> --}}
    <section id="category-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 left-section">
                    <h2>Our <span>Facilities<span></h2>
                    <p class="section-description">We provide a wide range of facilities to ensure a holistic learning
                        experience for our students. From state-of-the-art labs to spacious sports facilities, we prioritize
                        both academic and extracurricular growth.</p>
                </div>
                <div class="col-lg-7">
                    <div class="row equal-height">
                        @foreach ([['icon' => 'fa-flask', 'label' => 'Laboratories', 'description' => 'Modern labs for practical learning resources.'], ['icon' => 'fa-futbol', 'label' => 'Sports Facility', 'description' => 'Fields and courts for various sports games.'], ['icon' => 'fa-book', 'label' => 'Library', 'description' => 'Extensive collection of books and resources.'], ['icon' => 'fa-chalkboard-teacher', 'label' => 'Digital Class', 'description' => 'Smart classrooms for interactive learning.'], ['icon' => 'fa-utensils', 'label' => 'Canteen', 'description' => 'Nutritious and hygienic meals for students.'], ['icon' => 'fa-microphone', 'label' => 'Auditorium', 'description' => 'Modern space for events and performances.']] as $item)
                            <div class="col-md-4 mb-5">
                                <div class="facility-card">
                                    <i class="fas {{ $item['icon'] }}"></i>
                                    <strong>{{ $item['label'] }}</strong>
                                    <p>{{ $item['description'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="stats-section">
        <div class="container">
            <div class="row justify-content-center">
                @php
                    $stats = [
                        ['icon' => 'fa-solid fa-user-graduate', 'count' => '1200+', 'title' => 'Students'],
                        ['icon' => 'fa-solid fa-chalkboard-teacher', 'count' => '85+', 'title' => 'Teachers'],
                        ['icon' => 'fa-solid fa-award', 'count' => '25+', 'title' => 'Years of Excellence'],
                    ];
                @endphp

                @foreach ($stats as $stat)
                    <div class="col-md-4 col-sm-6 mb-4" data-aos="fade-up">
                        <div class="stat-card">
                            <i class="{{ $stat['icon'] }}"></i>
                            <h2 class="count-number" data-target="{{ preg_replace('/\D/', '', $stat['count']) }}">0</h2>
                            <p>{{ $stat['title'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- End of Category section -->


    {{-- Principal message section --}}
    <div class="container principal-section">
        <div class="principal-quote-container text-center max-w-xl mx-auto">
            <div class="principal-image-container mb-4">
                <img src="{{ asset($principalMsg->image_url) }}" alt="Principal"
                    class="rounded shadow-md w-full max-w-xs mx-auto">
                <p class="principal-name font-semibold mt-2 text-lg">{{ $principalMsg->image_name }}</p>
            </div>

            <p id="principal-message" class="principal-quote text-gray-700 text-base leading-relaxed">
                {{ $principalMsg->image_description }}
            </p>

            <a href="{{ route('principal.msg') }}">
                <button
                    style="
            background-color: transparent;
            color: #2563eb; /* blue text */
            padding: 10px 20px;
            border: 1px solid #2563eb; /* blue border */
            border-radius: 5px;
            margin-top: 16px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
        "
                    onmouseover="this.style.backgroundColor='#2563eb'; this.style.color='white';"
                    onmouseout="this.style.backgroundColor='transparent'; this.style.color='#2563eb';">
                    Read More
                </button>
            </a>

        </div>
    </div>


    {{-- Why choose us section --}}
    <section class="why-choose-section">
        <div class="container">
            <div class="why-choose-header">
                <h2>Why Choose Us?</h2>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="why-card">
                                <div class="icon-title-wrap">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <h3>Expert Instructors</h3>
                                </div>
                                <p>Learn from top industry professionals who bring years of real-world experience to the
                                    classroom, providing you with the latest tools, techniques, and insights needed to excel
                                    in your field.</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="why-card">
                                <div class="icon-title-wrap">
                                    <i class="fas fa-certificate"></i>
                                    <h3>Career-Boost Certify</h3>
                                </div>
                                <p>Earn certifications that are highly regarded by employers, helping you to enhance your
                                    resume, gain industry recognition, and open doors to new career opportunities.</p>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="why-card">
                                <div class="icon-title-wrap">
                                    <i class="fas fa-book"></i>
                                    <h3>100+ High Impact Courses</h3>
                                </div>
                                <p>We offer over 100 courses that cover essential skills in today’s tech industry. Whether
                                    you’re a beginner or an experienced professional, our courses provide hands-on learning
                                    to help you apply your skills immediately.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cta-card">
                        <div class="icon-title-wrap">
                            <i class="fas fa-clock"></i>
                            <h3>Flexible Learning Schedules</h3>
                        </div>
                        <p>Learn at your own pace with our flexible learning options. Balance your education with a busy
                            lifestyle and achieve your goals on your own schedule.</p>
                        <a href="{{ route('contact') }}" class="cta-btn">Contact us →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>





<!-- Events -->


    <div class="mt-80">
        @foreach ($events as $commonHeader => $group)
            <div class="event-section {{ $loop->index % 2 == 0 ? 'bg-light' : '' }}">
                <div class="container">
                    <h3 class="mb-4" style="color: #0f64af">{{ $commonHeader }}</h3>
                    <div class="event-carousel-container">
                        <button class="scroll-btn left" onclick="scrollEvents(this, -1)"><i
                                class="fas fa-chevron-left"></i></button>
                        <div class="event-carousel">
                            @foreach ($group as $event)
                                <div class="event-card">
    <a href="{{ route('events.list') }}" class="image-wrapper">
        <img src="{{ $event->image_url }}" alt="event">
    </a>
    <div class="card-body">
        <h5 class="card-title">{{ $event->header }}</h5>
    </div>
</div>
                            @endforeach
                        </div>
                        <button class="scroll-btn right" onclick="scrollEvents(this, 1)"><i
                                class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>






    <!-- End of Events Section -->




    <!-- -- News & Events Overlay Image Card -- -->
    <a href="{{ route('news.index') }}" class="scrollcontainer card news-events" style="text-decoration: none;">
        <div class="news-container">
            {{-- Scrolling Images --}}
            <div class="news-images">
                @foreach ($scrollers as $news)
                    @if (!empty($news->image_url))
                        <img src="{{ asset($news->image_url) }}" alt="{{ $news->title }}" class="news-image" />
                    @endif
                @endforeach
            </div>

            {{-- Overlay text --}}
            <div class="news-overlay">
                <p class="news-title">News & Events</p>
            </div>
        </div>
    </a>


    <!-- Announcements Section -->


    @if ($announcements->count())
        <!-- Toggle Button -->
        <button id="toggle-btn" class="blinking-text  btn btn-light position-fixed"
            style="top: 120px; right: 20px; z-index: 10000;">
           <i class="fa fa-bell"></i></a>
            <!-- <span>{{ $announcementCount ?? 0 }}</span> -->
        </button>

        <!-- Notification Box -->

        <div id="notification-box" class="notification-box">
            @foreach ($announcements as $announcement)
                <div class="blinking-text mb-2"
                    style="border: 2px solid white; min-width: 220px; border-radius: 8px; padding: 10px;">
                    <strong>{{ $announcement->header }}</strong><br>
                    <p>{{ $announcement->description }}</p>

                    @foreach ($announcement->files as $file)
                        <div class="mb-2">
                            <a href="{{ route('announcements.files.download', [
                                'announcementId' => $announcement->id,
                                'fileId' => $file->id,
                            ]) }}"
                                class="btn btn-sm btn-outline-primary" title="Download {{ $file->original_filename }}">
                                <i class="fas fa-download"></i>
                                Download {{ strtoupper($file->file_extension) }} File
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach

        </div>




        <section id="contact-section">
            <div class="container">
                <div class="contact-header">
                    <h2>Get In Touch</h2>
                    <p>We'd love to hear from you! Whether you have questions, need support, or want to learn more about our
                        services, our team is here to help.</p>
                </div>
                <div class="contact-info">
                    <div class="info-card">
                        <div class="icon-title-wrap">
                            <i class="fas fa-map-marker-alt"></i>
                            <h4>Our Address</h4>
                        </div>
                        Sivagiri Vidyaniketan
                        Vadihira Rd, Keeramkunnu,
                        <p>Keezhmadu, Aluva, <br>Kerala 683105</p>
                    </div>
                    <div class="info-card">
                        <div class="icon-title-wrap">
                            <i class="fas fa-mobile-alt "></i>
                            <h4>Our Contact Info</h4>
                        </div>
                        <p>+91 7994573586<br>
                            +0484-2632102, 2626490<br>
                            svidyaaluva@yahoo.com <br>
                            aluvasvidya@gmail.com</p>
                    </div>
                    <div class="info-card">
                        <div class="icon-title-wrap">
                            <i class="fas fa-clock"></i>
                            <h4>School Timing</h4>
                        </div>
                        <p>Monday - Friday: 8:20 AM - 3:00 PM<br>Saturday: 9:00 AM - 1:00 PM<br>Sunday: Closed</p>
                    </div>
                </div>
                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d251382.73388440683!2d76.380997!3d10.110935000000001!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x162afe6ad79d5654!2sSivagiri%20Vidyaniketan!5e0!3m2!1sen!2sin!4v1658994074003!5m2!1sen!2sin"
                        class="map-frame" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                        title="Google Map Embed"></iframe>
                </div>


                {{-- getin touch --}}
                <div class="contact-form-container">
                    <h3>Get in Touch</h3>
                    <form id="contactForm" action="{{ route('contact.getintouch') }}" method="POST">
                        @csrf <!-- Add CSRF token for Laravel -->
                        <div class="form-row" style="display: flex; flex-wrap: wrap; gap: 20px;">
                            <div class="form-group" style="flex: 1 1 calc(50% - 20px);">
                                <i class="fas fa-user"></i>
                                <input type="text" name="name" placeholder="Enter your name..." required>
                            </div>
                            <div class="form-group" style="flex: 1 1 calc(50% - 20px);">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" placeholder="Enter your email..." required>
                            </div>
                            <div class="form-group" style="flex: 1 1 calc(50% - 20px);">
                                <i class="fas fa-tag"></i>
                                <input type="text" name="subject" placeholder="Enter your subject..." required>
                            </div>
                            <div class="form-group" style="flex: 1 1 calc(50% - 20px);">
                                <i class="fas fa-phone"></i>
                                <input type="text" name="phone" placeholder="Enter your phone number..." required>
                            </div>
                        </div>
                        <div class="form-group mt-4"
                            style="flex: 1 1 calc(50% - 20px); display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-comment"></i>
                            <textarea name="messege" placeholder="Enter your message..." rows="4" style="flex: 1;" required></textarea>
                        </div>
                        <button type="submit" class="submit-btn" id="submitBtn">Submit</button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Start of the CTAs Section -->

        <section class="cta-section">
            <div class="cta-overlay"></div>
            <div class="cta-content">
                <h2>Empowering Education Through Technology</h2>
                <p>Discover a modern learning environment built for students, parents, and teachers. Join us in shaping the
                    future of education at Sree Narayana Vidyaniketan.</p>
                <a href="{{ route('contact') }}" class="cta-button">Apply Now</a>
            </div>
        </section>
        <!-- End  of the CTAs Section -->




    @endif



    <script>
        // Pass PHP array to JavaScript
        const announcements = @json($principalMsg->description);

        console.log(announcements);
    </script>

    <script>
        const principalMessageText = @json($principalMsg->description);
    </script>

    <script src="{{ asset('frontend/js/principal-message.js') }}"></script>

    <!-- Side Notification section JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const box = document.getElementById('notification-box');
            const button = document.getElementById('toggle-btn');

            button.addEventListener('click', () => {
                const isHidden = box.style.display === 'none';

                box.style.display = isHidden ? 'block' : 'none';
                button.innerHTML = isHidden ?
                    '<i class="fa fa-bell"></i>' :
                    '<i class="fa fa-bell-slash"></i>'; // optionally toggle icon
            });
        });
    </script>



    <!-- Start Quick stats Js file -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({
            once: true
        });

        $('.quick-stats-slider').slick({
            dots: false,
            infinite: true,
            speed: 600,
            slidesToShow: 3,
            arrows: true,
            responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });

        function animateCountUp(el) {
            const target = parseInt(el.getAttribute('data-count'));
            const duration = 1500;
            const frameRate = 1000 / 60;
            let start = 0;
            const steps = Math.ceil(duration / frameRate);
            const increment = target / steps;

            const counter = setInterval(() => {
                start += increment;
                if (start >= target) {
                    el.innerText = target + "+";
                    clearInterval(counter);
                } else {
                    el.innerText = Math.floor(start) + "+";
                }
            }, frameRate);
        }

        function isInViewport(el) {
            const rect = el.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        }

        function triggerCountOnVisible() {
            document.querySelectorAll('.count-up:not(.counted)').forEach(el => {
                if (isInViewport(el)) {
                    el.classList.add('counted');
                    animateCountUp(el);
                }
            });
        }

        // On load and scroll
        window.addEventListener('load', triggerCountOnVisible);
        window.addEventListener('scroll', triggerCountOnVisible);

        // On slick slide change
        $('.quick-stats-slider').on('afterChange', function() {
            triggerCountOnVisible();
        });
    </script>

    <!-- End of Quick stats -->

    <!-- Events section Button Click -->
    <script>
        function scrollEvents(button, direction) {
            // Find the closest .event-carousel sibling to the button
            const container = button.parentElement.querySelector('.event-carousel');
            const scrollAmount = 280; // Adjust this pixel value as needed

            container.scrollBy({
                left: direction * scrollAmount,
                behavior: 'smooth'
            });
        }
    </script>

    {{-- counte increase --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('.count-number');
            const options = {
                threshold: 0.6
            };

            const runCounter = (entry) => {
                const el = entry.target;
                const target = +el.getAttribute('data-target');
                let count = 0;
                const increment = target / 100;

                const updateCounter = () => {
                    count += increment;
                    if (count < target) {
                        el.textContent = Math.ceil(count);
                        requestAnimationFrame(updateCounter);
                    } else {
                        el.textContent = target.toLocaleString() + '+';
                    }
                };

                updateCounter();
            };

            const observer = new IntersectionObserver((entries, observerInstance) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        runCounter(entry);
                        observerInstance.unobserve(entry.target); // Run once
                    }
                });
            }, options);

            counters.forEach(counter => {
                observer.observe(counter);
            });
        });
    </script>

    <script>
        document.getElementById('contactForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.textContent;

            // Change button to loading state
            submitBtn.textContent = 'Submitting...';
            submitBtn.disabled = true;

            try {
                const formData = new FormData(this);
                const response = await fetch(this.action, {
                    method: this.method,
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    alert(data.message);
                    this.reset();
                } else {
                    // Handle validation errors
                    if (data.errors) {
                        let errorMessages = '';
                        for (const field in data.errors) {
                            errorMessages += data.errors[field].join('\n') + '\n';
                        }
                        alert('Validation errors:\n' + errorMessages);
                    } else {
                        alert(data.message || 'There was an error submitting the form.');
                    }
                }
            } catch (error) {
                alert('There was a problem sending your message. Please try again.');
                console.error('Error:', error);
            } finally {
                // Reset button to original state
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }
        });
    </script>

@endsection



<!-- @section('scripts')
                                                                                                                                                                                                                                                                                                                                                                            <script src="{{ asset('js/principal-message.js') }}"></script> -->
