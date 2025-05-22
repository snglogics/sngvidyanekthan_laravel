<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>

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
   <!--====== FOOTER PART START ======-->
    
   <footer id="footer-part">
        <div class="footer-top pt-40 mt-20 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-about mt-40">
                            <div class="logo">
                                <a href="#"><img src="{{asset('frontend/images/logo.png')}}" alt="Logo"></a>
                            </div>
                            <p>Gravida nibh vel velit auctor aliquetn quibibendum auci elit cons equat ipsutis sem nibh id elit. Duis sed odio sit amet nibh vulputate.</p>
                            <ul class="mt-20">
                                <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div> <!-- footer about -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="footer-link mt-40">
                            <div class="footer-title pb-25">
                                <h6>Sitemap</h6>
                            </div>
                            <ul>
                                <li><a href="{{ route('home') }}"><i class="fa fa-angle-right"></i>Home</a></li>
                                <li><a href="{{ route('about') }}"><i class="fa fa-angle-right"></i>About us</a></li>
                                <li><a href="{{ route('house_life')}}"><i class="fa fa-angle-right"></i>Activities</a></li>
                                <li><a href="{{ route('news.index')}}"><i class="fa fa-angle-right"></i>News</a></li>
                                <li><a href="{{route('events.list')}}"><i class="fa fa-angle-right"></i>Event</a></li>
                            </ul>
                            <ul>
                                <li><a href="{{ route('gallery.list')}}"><i class="fa fa-angle-right"></i>Gallery</a></li>
                                <li><a href="shop.html"><i class="fa fa-angle-right"></i>Shop</a></li>
                                <li><a href="{{ route('teachers.public')}}"><i class="fa fa-angle-right"></i>Teachers</a></li>
                                <li><a href="#"><i class="{{ route('frontend.sports_games.index')}}"></i>Sprots</a></li>
                                <li><a href="{{ route('contact')}}"><i class="fa fa-angle-right"></i>Contact</a></li>
                            </ul>
                        </div> <!-- footer link -->
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="footer-link support mt-40">
                            <div class="footer-title pb-25">
                                <h6>Support</h6>
                            </div>
                            <ul>
                                <li><a href="#"><i class="fa fa-angle-right"></i>FAQS</a></li>
                                <li><a href="#"><i class="fa fa-angle-right"></i>Privacy</a></li>
                                <li><a href="#"><i class="fa fa-angle-right"></i>Policy</a></li>
                                <li><a href="#"><i class="fa fa-angle-right"></i>Support</a></li>
                                <li><a href="#"><i class="fa fa-angle-right"></i>Documentation</a></li>
                            </ul>
                        </div> <!-- support -->
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-address mt-40">
                            <div class="footer-title pb-25">
                                <h6>Contact Us</h6>
                            </div>
                            <ul>
                                <li>
                                    <div class="icon">
                                        <i class="fa fa-home"></i>
                                    </div>
                                    <div class="cont">
                                        <p>143 castle road 517 district, kiyev port south Canada</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="cont">
                                        <p>+3 123 456 789</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <i class="fa fa-envelope-o"></i>
                                    </div>
                                    <div class="cont">
                                        <p>info@yourmail.com</p>
                                    </div>
                                </li>
                            </ul>
                        </div> <!-- footer address -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- footer top -->
        
        <div class="footer-copyright pt-10 pb-25">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="copyright text-md-left text-center pt-15">
                            <p><a target="_blank" href="https://www.snglogics.com">SGN Logics</a> </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="copyright text-md-right text-center pt-15">
                           
                        </div>
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- footer copyright -->
    </footer>
    
    <!--====== FOOTER PART ENDS ======-->
   
    <!--====== BACK TO TP PART START ======-->
    
    <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
    
    <!--====== BACK TO TP PART ENDS ======-->
   
    
    
    
    
    
    
    
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

<!-- Google Maps and Map Script -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDC3Ip9iVC0nIxC6V14CKLQ1HZNF_65qEQ"></script>
<script src="{{ asset('frontend/js/map-script.js') }}"></script> 
</body>
</html>