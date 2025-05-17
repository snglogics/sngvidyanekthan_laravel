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
                           <p>Opening Hours : Monday to Saturay - 8 Am to 5 Pm</p>
                       </div>
                   </div>
               </div> <!-- row -->
           </div> <!-- container -->
       </div> <!-- header top -->
       
       <div class="header-logo-support pt-30 pb-30" style="background-color: #001f4d; color: white;">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="logo">
                    <a href="index-2.html">
                        <img src="{{ asset('frontend/images/logo.png') }}" alt="Logo" style="width: 200px; height: auto;">
                    </a>
                </div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="support-button float-right d-none d-md-block">
                    <!-- <div class="support float-left">
                        <div class="icon">
                            <img src="{{ asset('frontend/images/all-icon/support.png') }}" alt="icon">
                        </div>
                        <div class="cont">
                            <p>Need Help? Call us free</p>
                            <span style="color: rgb(196, 209, 7);">321 325 5678</span>
                        </div>
                    </div> -->

                    <div class="button float-left ml-3 dropdown">
                    <a href="#" class="main-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Online Application
</a>
<div class="dropdown-menu">
<a class="dropdown-item" href="{{ route('student.form') }}">
    📄 For LKG
</a>
<a class="dropdown-item" href="{{ route('admissions.form') }}">📄 Class 1 to 10</a>
<a class="dropdown-item" href="{{ route('higher-admission.form') }}">📄 For Plus One & Plus Two</a>
</div>
                    </div>

                    <!-- New Dropdown Button -->
                    <div class="button float-left ml-3 dropdown">
                    <a href="#" class="main-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Application Form
</a>
<div class="dropdown-menu">
<a class="dropdown-item" href="https://docs.google.com/forms/d/e/1FAIpQLSchCpl-toWyB0eNfrmxfXvylMEuqx_F5vxSgsLtLAcTdmH8Aw/viewform" target="_blank">
    📄 For LKG
</a>
<a class="dropdown-item" href="http://sivagirividyaniketan.edu.in/application-form-for-i-ix/" target="_blank">📄 Class 1 to 10</a>
<a class="dropdown-item" href="https://docs.google.com/forms/d/e/1FAIpQLSdsdaaACy5hvhkYDgl1n98vV-AUTmKRmnKnqqJT7TyR3ggoxQ/viewform" target="_blank">📄 For Plus One & Plus Two</a>
</div>
                    </div>
                    <div class="button float-left ml-3">
                        <a href="https://epay.federalbank.co.in/easypayments/" target="_blank" class="main-btn">Fee Payment</a>
                    </div>
                </div> <!-- support-button -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</div>
 <!-- header logo support -->
       <div class="navigation">
           <div class="container">
               <div class="row">
                   <div class="col-lg-10 col-md-10 col-sm-9 col-8">
                       <nav class="navbar navbar-expand-lg">
                           <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                               aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                               <span class="icon-bar"></span>
                               <span class="icon-bar"></span>
                               <span class="icon-bar"></span>
                           </button>
       
                           <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                               <ul class="navbar-nav mr-auto">
                                   <li class="nav-item">
                                       <a class="active" href="{{ route('home') }}">Home</a>
                                   </li>
                                   <li class="nav-item">
                                   <a href="{{ route('about') }}">About</a>
                                       <ul class="sub-menu">
                                            <li><a href="{{ route('about') }}">School History</a></li>
                                           <li><a href="{{ route('school.vision') }}">Mission and Vision</a></li>
                                           <li><a href="{{ route('principal.msg') }}">Messages</a></li>
                                           <li><a href="{{ route('campus-overviews.frontendIndex') }}">Campus Overview</a></li>
                                           <li><a href="{{ route('school.info') }}">Who We Are</a></li>
                                           <li><a href="{{ route('teachers.public') }}">Teacher's Details</a></li>
                                         
                                           
                                       </ul>
                                   </li>
                                   <li class="nav-item">
                                       <a href="academics.html">Academics</a>
                                       <ul class="sub-menu">
                                           <li><a href="{{ route('curriculums.list') }}">Curriculum details </a></li>
                                         
                                           <li><a href="{{ route('academic-calendar.frontend') }}">Academic Calendar</a></li>
                                           <li><a href="{{ route('syllabus.list') }}">Online syllabus</a></li>
                                   
                                           <li><a href="{{ route('timetable.list') }}">Timetable</a></li>
                                       </ul>
                                   </li>    
                                   <li class="nav-item">
                                       <a href="facilities.html">Faculty</a>
                                       <ul class="sub-menu">
                                           <!-- <li><a href="{{ route('teachers.public') }}"> Teacher and staff</a></li>
                                           <li><a href="{{ route('teachers.profile') }}"> Profiles</a></li> -->
                                           <li><a href="{{ route('admin.live-classes.index') }}">Digital Class Rooms</a></li>
                                           <li><a href="{{ route('teachers.categorized') }}">Teachers & Staff</a></li>
                                           <li><a href="{{ route('frontend.bus_routes') }}">Bus Route</a></li>
                                          
                                       </ul>
                                   </li>
                                   <li class="nav-item">
                                       <a href="activities.html">Activities</a>
                                       <ul class="sub-menu">
                                           <li><a href="{{route('frontend.co_curricular_programs.index')}}">Co-Curricular Activities</a></li>
                                           <li><a href="{{route('events.list')}}">Events</a></li>
                                           <li><a href="#">Club activities </a></li>
                                           <li><a href="{{route('interschool-participations.index')}}">Inter-school participation & results
                                           </a></li>
                                         
                                           <li><a href="{{route('frontend.sports_games.index')}}">Sports</a></li>
                                           <li><a href="swamiji-visiting.html">Swamiji Visiting</a></li>
                                       </ul>
                                   </li>
                                   <li class="nav-item">
                                       <a href="achievements.html">Achievements</a>
                                       <ul class="sub-menu">
                                       <li><a href="{{route('frontend.academic_performances.index')}}">Academic performance</a></li>
                                           <li><a href="{{route('frontend.sports_awards.index')}}">Sports awards</a></li>
                                           <li><a href="{{route('frontend.cultural_competitions.index')}}">Cultural competition recognitions </a></li>
                                           
                                          
                                       </ul>
                                   </li>
                                   <li class="nav-item">
                                       <a href="media.html">Gallery</a>
                                       <ul class="sub-menu">
                                           
                                           <li><a href="{{ route('gallery.list')}}">Events Gallery</a></li>
                                           <li><a href="{{ route('gallery.list')}}">Lab & Library</a></li>
                                           <li><a href="{{ route('magazines.list')}}">magazine</a></li>
                                           <li><a href="{{ route('videos.list')}}">Videos</a></li>
                                       </ul>
                                   </li>
                                   <li class="nav-item">
                                       <a href="media.html">Student Life</a>
                                       <ul class="sub-menu">
                                           
                                           <li><a href="{{ route('house_life')}}">House System</a></li>
                                           <li><a href="{{ route('frontend.sports_games.index')}}"> Sports & Games</a></li>
                                           <li><a href="{{ route('student_council')}}">Student Council</a></li>
                                           <li><a href="{{ route('frontend.field_trips.index')}}">Field Trips and Tours</a></li>
                                       </ul>
                                   </li>
                                   <li class="nav-item">
                                       <a href="media.html">Events</a>
                                       <ul class="sub-menu">
                                           <li><a href="{{ route('academic-calendar.frontend') }}">Upcoming event calendar</a></li>
                                           <li><a href="{{ route('news.index')}}">News</a></li>
                                           
                                           <li><a href="newsletter.html">Public updates</a></li>
                                           <li><a href="newsletter.html">School curriculars /  announcement</a></li>
                                           <li><a href="{{ route('gallery.list')}}">Photo Gallery</a></li>
                                           <li><a href="{{ route('videos.list')}}">Videos</a></li>
                                       </ul>
                                   </li>
                                   <li class="nav-item">
                                       <a href="{{ route('contact')}}">Contact</a>
                                   </li>
                                   <li class="nav-item">
                                       <a href="http://sivagirividyaniketan.edu.in/wp-content/uploads/2023/07/MANDATORY-PUBLIC-DISCLOSURES.pdf">DISCLOSURE </a>
                                   </li>
                               </ul>
                           </div>
                       </nav>
                   </div>
                   <div class="col-lg-2 col-md-2 col-sm-3 col-4">
                       <!-- <div class="right-icon text-right">
                           <ul>
                               <li><a href="#" id="search"><i class="fa fa-search"></i></a></li>
                               <li ><a href="#"><i class="fa fa-bell"></i><span>{{ $announcementCount ?? 0 }}</span></a></li>
                           </ul>
                       </div> -->
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


</body>
</html>