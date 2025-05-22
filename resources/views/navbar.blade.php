<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNG VidyaNikethan</title>

      <!--====== Favicon Icon ======-->
 
      <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.png') }}" type="image/png">

<link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/jquery.nice-number.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/default.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">

</head>
<style>
    #digital-clock {
        font-family: 'Courier New', monospace; /* Fixed-width font */
        min-width: 80px;                       /* Reserve space for 8 characters (hh:mm:ss) */
        display: inline-block;                 /* Prevent shrinking */
        text-align: left;
    }
</style>
<body>
<header id="header-part">
       
       <div class="header-top d-none d-lg-block" style="background-color: #ffffff; color: rgb(0, 0, 0);">
           <div class="container" >
               <div class="row" >
                   <div class="col-lg-6">
                       <div class="header-contact text-lg-left text-center">
                           <ul>
                               <li><img src="{{ asset('frontend/images/all-icon/map.png') }}" alt="icon"><span>
                                   Bridge Rd, Periyar Nagar, Aluva, Kerala 683101</span>
                                   <img src="{{asset('frontend/images/all-icon/email.png')}}" alt="icon"><span>svidyaaluva@yahoo.com</span></li>
                           </ul>
                       </div>
                   </div>
                   <div class="col-lg-6">
                       <div class="header-opening-time text-lg-right text-center">
                           <p>Opening Hours : Monday to Saturay - 8 Am to 5 Pm
                             <span id="digital-clock" class="font-weight-bold ml-2">
                           </p>
                          
                       </div>
                   </div>
               </div> <!-- row -->
           </div> <!-- container -->
       </div> <!-- header top -->
       
<div class="header-logo-support pt-30 pb-30" style="background-color: #001f4d; color: white;">
    <div class="container">
  <div class="row align-items-center">
    <!-- Logo section -->
    <div class="col-lg-2 col-md-3 col-6">
      <div class="logo">
        <a href="#">
          <img src="{{ asset('frontend/images/logo.png') }}" alt="Logo" style="width: 150px; height: auto;">
        </a>
      </div>
    </div>

    <!-- Buttons section (Desktop) -->
    <div class="col-lg-10 col-md-9 d-none d-lg-flex justify-content-end align-items-center flex-wrap">
      <!-- Online Application Dropdown -->
      <div class="button ml-2 dropdown">
        <a href="#" class="main-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Online Application
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="{{ route('student.form') }}">📄 For LKG</a>
          <a class="dropdown-item" href="{{ route('admissions.form') }}">📄 Class 1 to 10</a>
          <a class="dropdown-item" href="{{ route('higher-admission.form') }}">📄 For Plus One & Plus Two</a>
        </div>
      </div>

      <!-- Application Form Dropdown -->
      <div class="button ml-2 dropdown">
        <a href="#" class="main-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Application Form
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="https://docs.google.com/forms/d/e/1FAIpQLSchCpl-toWyB0eNfrmxfXvylMEuqx_F5vxSgsLtLAcTdmH8Aw/viewform" target="_blank">📄 For LKG</a>
          <a class="dropdown-item" href="http://sivagirividyaniketan.edu.in/application-form-for-i-ix/" target="_blank">📄 Class 1 to 10</a>
          <a class="dropdown-item" href="https://docs.google.com/forms/d/e/1FAIpQLSdsdaaACy5hvhkYDgl1n98vV-AUTmKRmnKnqqJT7TyR3ggoxQ/viewform" target="_blank">📄 For Plus One & Plus Two</a>
        </div>
      </div>

      <!-- Fee Payment Button -->
      <div class="button ml-2">
        <a href="https://epay.federalbank.co.in/easypayments/" target="_blank" class="main-btn">Fee Payment</a>
      </div>

      <!-- Disclosure Button -->
      <div class="button ml-2">
        <a href="http://sivagirividyaniketan.edu.in/wp-content/uploads/2023/07/MANDATORY-PUBLIC-DISCLOSURES.pdf" target="_blank" class="main-btn">DISCLOSURE</a>
      </div>
    </div>

    <!-- Mobile toggle -->
    <div class="col-12 d-flex d-lg-none justify-content-end mt-2">
      <button class="btn btn-outline-primary" id="supportToggle">☰ Options</button>
    </div>

    <!-- Mobile Dropdown Menu -->
    <div class="col-12 d-lg-none">
      <div class="dropdown mt-2 d-none" id="mobileSupportMenu">
        <div class="dropdown-menu show p-2">
          <a class="dropdown-item" href="{{ route('student.form') }}">📄 Online Application - LKG</a>
          <a class="dropdown-item" href="{{ route('admissions.form') }}">📄 Online Application - Class 1 to 10</a>
          <a class="dropdown-item" href="{{ route('higher-admission.form') }}">📄 Online Application - Plus One & Two</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="https://docs.google.com/forms/d/e/1FAIpQLSchCpl-toWyB0eNfrmxfXvylMEuqx_F5vxSgsLtLAcTdmH8Aw/viewform" target="_blank">📄 Application Form - LKG</a>
          <a class="dropdown-item" href="http://sivagirividyaniketan.edu.in/application-form-for-i-ix/" target="_blank">📄 Application Form - Class 1 to 10</a>
          <a class="dropdown-item" href="https://docs.google.com/forms/d/e/1FAIpQLSdsdaaACy5hvhkYDgl1n98vV-AUTmKRmnKnqqJT7TyR3ggoxQ/viewform" target="_blank">📄 Application Form - Plus One & Two</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="https://epay.federalbank.co.in/easypayments/" target="_blank">💳 Fee Payment</a>
          <a class="dropdown-item" href="http://sivagirividyaniketan.edu.in/wp-content/uploads/2023/07/MANDATORY-PUBLIC-DISCLOSURES.pdf" target="_blank">📢 Disclosure</a>
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
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Navbar Links -->
                    <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto w-100 d-flex flex-wrap justify-content-between">
                            <li class="nav-item"><a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
@php
    $isAboutActive = in_array(Route::currentRouteName(), [
        'about',
        'school.vision',
        'principal.msg',
        'campus-overviews.frontendIndex',
        'school.info'
    ]);
@endphp
                            <li class="nav-item dropdown">
                                <a class="{{ $isAboutActive ? 'active' : '' }}" href="{{ route('about') }}">About</a>

                                <ul class="sub-menu">
                                    <li><a href="{{ route('about') }}">School History</a></li>
                                    <li><a href="{{ route('school.vision') }}">Mission and Vision</a></li>
                                    <li><a href="{{ route('principal.msg') }}">Messages</a></li>
                                    <li><a href="{{ route('campus-overviews.frontendIndex') }}">Campus Overview</a></li>
                                    <li><a href="{{ route('school.info') }}">School Info</a></li>
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
                               <a class="{{ $isAcademicsActive ? 'active' : '' }}" href="{{ route('curriculums.list') }}">Academics</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('curriculums.list') }}">Curriculum details </a></li>
                                    <li><a href="{{ route('academic-calendar.frontend') }}">Academic Calendar</a></li>
                                    <li><a href="{{ route('syllabus.list') }}">Online syllabus</a></li>
                                    <li><a href="{{ route('timetable.list') }}">Timetable</a></li>
                                </ul>
                            </li>
@php
    $isFacultyActive = in_array(Route::currentRouteName(), [
        'admin.live-classes.index',
        'teachers.categorized',
        'frontend.bus_routes',
    ]);
@endphp
                            <li class="nav-item dropdown">
                                <a class="{{ $isFacultyActive ? 'active' : '' }}" href="{{ route('admin.live-classes.index') }}">Faculty</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('admin.live-classes.index') }}">Digital Class Rooms</a></li>
                                    <li><a href="{{ route('teachers.categorized') }}">Teachers & Staff</a></li>
                                    <li><a href="{{ route('frontend.bus_routes') }}">Bus Route</a></li>
                                </ul>
                            </li>
@php
    $isActivitiesActive = in_array(Route::currentRouteName(), [
        'frontend.co_curricular_programs.index',
        'house_life',
        'interschool-participations.index',
        'frontend.sports_games.index'
    ]);
@endphp
                            <li class="nav-item dropdown">
                                 <a class="{{ $isActivitiesActive ? 'active' : '' }}" href="{{ route('frontend.co_curricular_programs.index') }}">Activities</a>
                                <ul class="sub-menu">
                                    <li><a href="{{route('frontend.co_curricular_programs.index')}}">Co-Curricular Activities</a></li>
                                    <li><a href="{{ route('house_life')}}">Club activities </a></li>
                                    <li><a href="{{route('interschool-participations.index')}}">Inter-school participation & results</a></li>
                                    <li><a href="{{route('frontend.sports_games.index')}}">Sports</a></li>
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
                                <a class="{{ $isAchievementsActive ? 'active' : '' }}" href="{{ route('frontend.academic_performances.index') }}">Achievements</a>
                                <ul class="sub-menu">
                                    <li><a href="{{route('frontend.academic_performances.index')}}">Academic performance</a></li>
                                    <li><a href="{{route('frontend.sports_awards.index')}}">Sports awards</a></li>
                                    <li><a href="{{route('frontend.cultural_competitions.index')}}">Cultural competition recognitions </a></li>
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
                                <a class="{{ $isGalleryActive ? 'active' : '' }}" href="{{ route('magazines.list') }}">Gallery</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('magazines.list')}}">Magazine</a></li>
                                    <li><a href="{{ route('gallery.list')}}">Photo Gallery</a></li>
                                    <li><a href="{{ route('videos.list')}}">Videos</a></li>
                                </ul>
                            </li>
@php
    $isStudentLifeActive = in_array(Route::currentRouteName(), [
        
        'student_council',
        'frontend.field_trips.index',
    ]);
@endphp
                            <li class="nav-item dropdown">
                               <a class="{{ $isStudentLifeActive ? 'active' : '' }}" href="{{ route('student_council') }}">Student Life</a>
                                <ul class="sub-menu">
                                    
                                    <li><a href="{{ route('student_council')}}">Student Council</a></li>
                                    <li><a href="{{ route('frontend.field_trips.index')}}">Field Trips and Tours</a></li>
                                </ul>
                            </li>
@php
    $isEventsActive = in_array(Route::currentRouteName(), [
        'academic-calendar.frontend',
        'news.index',
        'events.list',
        'newsletter.html'
    ]);
@endphp
                            <li class="nav-item dropdown">
                             <a class="{{ $isEventsActive ? 'active' : '' }}" href="{{ route('academic-calendar.frontend') }}">Events</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('academic-calendar.frontend') }}">Upcoming event calendar</a></li>
                                    <li><a href="{{ route('news.index')}}">News</a></li>
                                    <li><a href="{{route('events.list')}}">Events Gallery</a></li>
                                   
                                </ul>
                            </li>

                            <li class="nav-item"><a class="{{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a></li>
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

<!-- Bootstrap JS -->
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>

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

<!-- Then Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Google Maps and Map Script -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDC3Ip9iVC0nIxC6V14CKLQ1HZNF_65qEQ"></script>
<script src="{{ asset('frontend/js/map-script.js') }}"></script>

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
</body>
</html>