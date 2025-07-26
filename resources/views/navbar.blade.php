<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sivagiri Vidyaniketan</title>

    <!--====== Favicon Icon ======-->


    <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.png') }}" type="image/png">

    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.nice-number.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">




</head>
<style>
    #digital-clock {
        font-family: 'Courier New', monospace;
        /* Fixed-width font */
        min-width: 80px;
        /* Reserve space for 8 characters (hh:mm:ss) */
        display: inline-block;
        /* Prevent shrinking */
        text-align: left;
    }

    .kinder-button-wrapper {
        position: relative;
        width: 200px;
        height: 60px;
        margin: 20px;
        overflow: hidden;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .kinder-button-wrapper::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 200%;
        height: 100%;
        background: url('/frontend/images/kinder.jpg') no-repeat center center;
        background-size: cover;
        animation: move-bg 10s linear infinite;
        z-index: 1;
        opacity: 0.6;
    }

    @keyframes move-bg {
        0% {
            left: -100%;
        }

        100% {
            left: 0;
        }
    }

    .kinder-button {
        position: relative;
        z-index: 2;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        font-size: 20px;
        font-weight: bold;
        text-transform: uppercase;
        color: #fff;
        background-color: rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(2px);
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.4s ease;
        animation: fadeInText 1.5s ease-out forwards;
        opacity: 0;
        /* Border effect */
        -webkit-text-stroke: 1px #ff9900;
        /* Actual border */
        text-shadow:
            0 0 5px #00ffcc,
            0 0 10px #00ffcc,
            0 0 15px #00ffcc;
        /* Glowing border */
    }

    @keyframes fadeInText {
        from {
            opacity: 0;
            transform: translateY(20px) scale(0.95);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .kinder-button:hover {
        background-color: rgba(0, 0, 0, 0.5);
        animation: bounceHover 0.6s ease;
    }

    @keyframes bounceHover {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
        }
    }

    .sparkle-text {
        position: relative;
        display: inline-block;
        background: linear-gradient(90deg, #fff, #ffd700, #fff);
        background-size: 200% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: sparkle 4s linear infinite;
        font-weight: 600;
    }

    @keyframes sparkle {
        0% {
            background-position: 200% center;
        }

        50% {
            background-position: -100% center;
        }

        100% {
            background-position: -200% center;
        }
    }

    <style>.shimmer-logo {
        display: inline-block;
        position: relative;
    }

    .shimmer-logo::before {
        content: "";
        position: absolute;
        top: 0;
        left: -150%;
        width: 150%;
        height: 100%;
        background: linear-gradient(120deg,
                transparent 0%,
                rgba(255, 255, 255, 0.3) 50%,
                transparent 100%);
        animation: shimmerMove 2.5s infinite;
        z-index: 1;
    }

    .shimmer-logo img {
        display: block;
        position: relative;
        z-index: 2;
    }

    @keyframes shimmerMove {
        0% {
            left: -150%;
        }

        100% {
            left: 150%;
        }
    }
</style>




</style>

<body>
    <header id="header-part">

        <div class="header-top d-none d-lg-block" style="background-color: #ffffff; color: rgb(0, 0, 0);">
            <div class="container">
                <div class="row overflow-hidden">
                    <div class="col-lg-6">
                        <div class="header-contact text-lg-left text-center">
                            <ul>
                                <li class="sparkle-container">
                                    <img src="{{ asset('frontend/images/all-icon/map.png') }}" alt="icon">
                                    <span class="sparkle-text">Bridge Rd, Periyar Nagar, Aluva, Kerala 683101</span>

                                    <img src="{{ asset('frontend/images/all-icon/email.png') }}" alt="icon">
                                    <span class="sparkle-text">aluvasvidya@gmail.com</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="header-opening-time text-lg-right text-center sparkle-text">
                            <p>Opening Hours : Monday to Saturay - 8.20 AM to 3.00 PM
                                <span id="digital-clock" class="font-weight-bold ml-2">
                            </p>
                        </div>
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- header top -->

        <div class="header-logo-support pt-7 pb-7" style="background-color: #001f4d; color: white;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
                        <!-- Left Section: Logo and School Name -->
                        <div class="d-flex align-items-center" style="flex: 1; min-width: 300px; margin-bottom: 10px;">
                            <!-- Logo -->
                            <div class="logo" style="flex-shrink: 0;">
                                <a href="#">
                                    <img src="{{ asset('frontend/images/logobgrmved.png') }}" alt="Logo"
                                        style="width: 100px; height: 100px;">
                                </a>
                            </div>
                            <!-- School Name -->
                            <div class="school-name sparkle-effect ms-1"
                                style="font-family: 'Algerian'; flex-shrink: 1;">
                                <div class="fw-bold">SIVAGIRI VIDYANIKETHAN</div>
                                <div class="text-uppercase small">Senior Secondary School, ALUVA</div>
                                <div class="text-uppercase small">(CBSE AFFILIATION NO,930060)</div>
                            </div>
                        </div>

                        <!-- Right Section: Buttons (Desktop only) -->
                        <div class="d-none d-lg-flex align-items-center" style="flex-wrap: nowrap; flex-shrink: 0;">
                            <div class="kinder-button-wrapper me-2" style="flex-shrink: 0;">
                                <a href="{{ route('kindergarten.sliders') }}" class="kinder-button">Kinder Garten</a>
                            </div>

                            <div class="button dropdown me-2" style="flex-shrink: 0;">
                                <a href="#" class="main-btn dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Application Form
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('student.form') }}">📄 For LKG</a>
                                    <a class="dropdown-item" href="{{ route('admissions.form') }}">📄 Class 1 to 10</a>
                                    <a class="dropdown-item" href="{{ route('higher-admission.form') }}">📄 For Plus
                                        One & Plus Two</a>
                                </div>
                            </div>

                            <div class="button me-2" style="flex-shrink: 0;">
                                <a href="https://epay.federalbank.co.in/easypayments/DIRECTPAYMENT.ASPX?CODE=LIKPELIRD1Y"
                                    target="_blank" class="main-btn">Fee Payment</a>
                            </div>

                            {{-- <div class="button me-2" style="flex-shrink: 0;">
                                <a href="http://sivagirividyaniketan.edu.in/wp-content/uploads/2023/07/MANDATORY-PUBLIC-DISCLOSURES.pdf"
                                    target="_blank" class="main-btn">DISCLOSURE</a>
                            </div> --}}
                            <div class="button dropdown me-2" style="flex-shrink: 0;">
                                <a href="#" class="main-btn dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Certificates
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item"
                                        href="http://sivagirividyaniketan.edu.in/wp-content/uploads/2023/07/MANDATORY-PUBLIC-DISCLOSURES.pdf">📄
                                        DISCLOSURE</a>
                                    <a class="dropdown-item"
                                        href="http://sivagirividyaniketan.edu.in/wp-content/uploads/2023/07/MANDATORY-PUBLIC-DISCLOSURES.pdf">📄
                                        Fire & Safety</a>
                                    <a class="dropdown-item"
                                        href="http://sivagirividyaniketan.edu.in/wp-content/uploads/2023/07/MANDATORY-PUBLIC-DISCLOSURES.pdf">📄
                                        Other</a>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile Toggle Button -->
                        <div class="d-lg-none mt-2 mb-2" style="flex-shrink: 0;">
                            <button class="btn btn-outline-primary" id="supportToggle">☰ Options</button>
                        </div>
                    </div>

                    <!-- Mobile Dropdown Menu -->
                    <div class="col-12 d-lg-none">
                        <div class="dropdown mt-2 d-none" id="mobileSupportMenu">
                            <div class="dropdown-menu show p-2">
                                <a class="dropdown-item" href="{{ route('student.form') }}">📄 Online Application -
                                    LKG</a>
                                <a class="dropdown-item" href="{{ route('admissions.form') }}">📄 Online Application
                                    - Class 1 to 10</a>
                                <a class="dropdown-item" href="{{ route('higher-admission.form') }}">📄 Online
                                    Application - Plus One & Two</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"
                                    href="https://epay.federalbank.co.in/easypayments/DIRECTPAYMENT.ASPX?CODE=LIKPELIRD1Y"
                                    target="_blank">💳 Fee Payment</a>
                                <a class="dropdown-item"
                                    href="http://sivagirividyaniketan.edu.in/wp-content/uploads/2023/07/MANDATORY-PUBLIC-DISCLOSURES.pdf"
                                    target="_blank">📢 Disclosure</a>
                                <a class="dropdown-item kinder-button"
                                    href="{{ route('kindergarten.sliders') }}">Kinder Garten</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div> <!-- row -->
        </div> <!-- container -->
        <!-- container -->
        </div>
        <!-- header logo support -->
        <div class="navigation">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-lg w-100">
                            <!-- Toggle Button -->
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                            <!-- Navbar Links -->
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto w-100 d-flex flex-wrap justify-content-between">
                                    <li class="nav-item"><a class="{{ request()->routeIs('home') ? 'active' : '' }}"
                                            href="{{ route('home') }}">Home</a></li>
                                    @php
                                        $isAboutActive = in_array(Route::currentRouteName(), [
                                            'about',
                                            'school.vision',
                                            'principal.msg',
                                            'campus-overviews.frontendIndex',
                                            'school.info',
                                        ]);
                                    @endphp
                                    <li class="nav-item dropdown">
                                        <a class="{{ $isAboutActive ? 'active' : '' }}"
                                            href="{{ route('about') }}">About</a>

                                        <ul class="sub-menu">
                                            <li><a href="{{ route('about') }}">School History</a></li>
                                            <li><a href="{{ route('school.vision') }}">Mission and Vision</a></li>
                                            <li><a href="{{ route('principal.msg') }}">Messages</a></li>
                                            <li><a href="{{ route('campus-overviews.frontendIndex') }}">Campus
                                                    Overview</a></li>
                                            <li><a href="{{ route('school.info') }}">School Info</a></li>
                                            {{-- <li><a href="{{ route('pta-members.index') }}">PTA Members</a></li> --}}
                                            <li><a href="{{ route('frontend.bus_routes') }}">Bus Route</a></li>

                                        </ul>
                                    </li>
                                    @php
                                        $isAcademicsActive = in_array(Route::currentRouteName(), [
                                            'curriculums.list',
                                            'academic-calendar.frontend',
                                            'syllabus.list',
                                            'timetable.list',
                                        ]);
                                    @endphp
                                    <li class="nav-item dropdown">
                                        <a class="{{ $isAcademicsActive ? 'active' : '' }}"
                                            href="{{ route('curriculums.list') }}">Academics</a>
                                        <ul class="sub-menu">
                                            <li><a href="{{ route('curriculums.list') }}">Assessment pattern </a></li>
                                            <li><a href="{{ route('academic-calendar.frontend') }}">Academic
                                                    Calendar</a></li>
                                            {{-- <li><a href="{{ route('syllabus.list') }}">Online syllabus</a></li> --}}
                                            <li><a href="{{ route('timetable.list') }}">Exam Timetable</a></li>
                                        </ul>
                                    </li>
                                    @php
                                        $isFacultyActive = in_array(Route::currentRouteName(), [
                                            'admin.live-classes.index',
                                            'frontend.bus_routes',
                                            'frontend.bus_routes',
                                        ]);
                                    @endphp
                                    <li class="nav-item dropdown">
                                        <a class="{{ $isFacultyActive ? 'active' : '' }}"
                                            href="{{ route('admin.live-classes.index') }}">Faculty</a>
                                        <ul class="sub-menu">
                                            {{-- <li><a href="{{ route('admin.live-classes.index') }}">Digital Class
                                                    Rooms</a></li> --}}
                                            <li><a href="{{ route('teachers.categorized') }}">Teachers & Staff</a>

                                            </li>

                                        </ul>
                                    </li>
                                    @php
                                        $isActivitiesActive = in_array(Route::currentRouteName(), [
                                            'frontend.co_curricular_programs.index',
                                            'house_life',
                                            'interschool-participations.index',
                                            'frontend.sports_games.index',
                                        ]);
                                    @endphp
                                    <li class="nav-item dropdown">
                                        <a class="{{ $isActivitiesActive ? 'active' : '' }}"
                                            href="{{ route('frontend.co_curricular_programs.index') }}">Activities</a>
                                        <ul class="sub-menu">
                                            <li><a href="{{ route('frontend.co_curricular_programs.index') }}">Co-Curricular
                                                    Activities</a></li>
                                            <li><a href="{{ route('house_life') }}">Club activities </a></li>
                                            <li><a href="{{ route('interschool-participations.index') }}">Inter-school
                                                    participation & results</a></li>
                                            <li><a href="{{ route('frontend.sports_games.index') }}">Sports</a></li>
                                        </ul>
                                    </li>
                                    @php
                                        $isAchievementsActive = in_array(Route::currentRouteName(), [
                                            'frontend.academic_performances.index',
                                            'frontend.sports_awards.index',
                                            'frontend.cultural_competitions.index',
                                        ]);
                                    @endphp
                                    <li class="nav-item dropdown">
                                        <a class="{{ $isAchievementsActive ? 'active' : '' }}"
                                            href="{{ route('frontend.academic_performances.index') }}">Achievements</a>
                                        <ul class="sub-menu">
                                            <li><a href="{{ route('frontend.academic_performances.index') }}">Academic
                                                    performance</a></li>
                                            <li><a href="{{ route('frontend.sports_awards.index') }}">Sports
                                                    awards</a></li>
                                            <li><a href="{{ route('frontend.cultural_competitions.index') }}">Cultural
                                                    competition recognitions </a></li>
                                        </ul>
                                    </li>
                                    @php
                                        $isGalleryActive = in_array(Route::currentRouteName(), [
                                            'magazines.list',
                                            'gallery.list',
                                            'videos.list',
                                        ]);
                                    @endphp
                                    <li class="nav-item dropdown">
                                        <a class="{{ $isGalleryActive ? 'active' : '' }}"
                                            href="{{ route('magazines.list') }}">Gallery</a>
                                        <ul class="sub-menu">
                                            <li><a href="{{ route('magazines.list') }}">Magazine</a></li>
                                            <!-- <li><a href="{{ route('gallery.list') }}">Photo Gallery</a></li> -->
                                            <li><a href="{{ route('videos.list') }}">Videos</a></li>
                                        </ul>
                                    </li>
                                    @php
                                        $isStudentLifeActive = in_array(Route::currentRouteName(), [
                                            'student_council',
                                            'frontend.field_trips.index',
                                        ]);
                                    @endphp
                                    <li class="nav-item dropdown">
                                        <a class="{{ $isStudentLifeActive ? 'active' : '' }}"
                                            href="{{ route('student_council') }}">Student Life</a>
                                        <ul class="sub-menu">

                                            {{-- <li><a href="{{ route('student_council.index') }}">Student Council</a> --}}
                                    </li>
                                    <li><a href="{{ route('frontend.field_trips.index') }}">Field Trips and
                                            Tours</a></li>
                                </ul>
                                </li>
                                @php
                                    $isEventsActive = in_array(Route::currentRouteName(), [
                                        'academic-calendar.frontend',
                                        'news.index',
                                        'events.list',
                                        'newsletter.html',
                                    ]);
                                @endphp
                                <li class="nav-item dropdown">
                                    <a class="{{ $isEventsActive ? 'active' : '' }}"
                                        href="{{ route('academic-calendar.frontend') }}">Events</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('academic-calendar.frontend') }}">Upcoming event
                                                calendar</a></li>
                                        <li><a href="{{ route('news.index') }}">News</a></li>
                                        <li><a href="{{ route('events.list') }}">Events Gallery</a></li>

                                    </ul>
                                </li>

                                <li class="nav-item"><a class="{{ request()->routeIs('contact') ? 'active' : '' }}"
                                        href="{{ route('contact') }}">Contact</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>



    </header>

    <!--====== jquery js ======-->
    <!-- Vendor JS -->
    <script src="{{ asset('frontend/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendor/jquery-1.12.4.min.js') }}"></script>


    <!-- Slick JS -->
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>

    <!-- Magnific Popup JS -->
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>

    <!-- Counter Up JS -->
    <script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>

    <!-- Nice Select JS -->
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>

    <!-- Nice Number JS -->
    <script src="{{ asset('frontend/js/jquery.nice-number.min.js') }}"></script>

    <!-- Count Down JS -->
    <script src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>

    <!-- Validator JS -->
    <script src="{{ asset('frontend/js/validator.min.js') }}"></script>

    <!-- Ajax Contact JS -->
    <script src="{{ asset('frontend/js/ajax-contact.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <!-- dropdown -->



    <!-- Then Popper.js (needed by Bootstrap dropdowns) -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>




    <script>
        document.getElementById('supportToggle').addEventListener('click', function() {
            const menu = document.getElementById('mobileSupportMenu');
            menu.classList.toggle('d-none');
        });
    </script>

    <script>
        function updateClock() {
            const now = new Date();
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');
            const timeString = `${hours}:${minutes}:${seconds}`;
            document.getElementById('digital-clock').textContent = timeString;
        }

        setInterval(updateClock, 1000);
        updateClock(); // Initial call
    </script>





    <script>
        const toggler = document.querySelector('.navbar-toggler');
        toggler.addEventListener('click', () => {
            toggler.classList.toggle('active');
        });
    </script>

</body>

</html>
