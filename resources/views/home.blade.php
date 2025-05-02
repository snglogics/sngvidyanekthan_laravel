@extends('layouts.layout')
@section('content')
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
    
   

    @foreach($sliders as $slider)
    <div class="single-slider bg_cover pt-150" style="background-image: url('{{ $slider['image_url'] }}')" data-overlay="4"> 
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-9">
                    <div class="slider-cont">
                        <h1 data-animation="bounceInLeft" data-delay="1s">{{ $slider['header'] ?? '' }}</h1>
                        <p data-animation="fadeInUp" data-delay="1.3s">{{ $slider['common_header'] ?? '' }}</p>
                        <ul>
                            <li><a data-animation="fadeInUp" data-delay="1.6s" class="main-btn" href="#">Read More</a></li>
                            <li><a data-animation="fadeInUp" data-delay="1.9s" class="main-btn main-btn-2" href="#">Get Started</a></li>
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
    
    <section id="category-part">
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
                            @foreach([
                                ['icon' => 'laboratory.png', 'label' => 'Laboratories', 'color' => 'color-1'],
                                ['icon' => 'sports.png', 'label' => 'Sport Facility', 'color' => 'color-2'],
                                ['icon' => 'libraray.png', 'label' => 'Library', 'color' => 'color-3'],
                                ['icon' => 'digitalClass.png', 'label' => 'Digital Class', 'color' => 'color-1'],
                                ['icon' => 'canteen.png', 'label' => 'Canteen', 'color' => 'color-2'],
                                ['icon' => 'auditorium.png', 'label' => 'Auditorium', 'color' => 'color-3'],
                            ] as $item)
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
</section>

   <!-- End of Category section -->
  
  <!-- -- Principal's Message Card -- -->
  <div class="card p-4 my-4 shadow-lg border-0" style="max-width: 1100px; margin: auto;">
    <div class="row g-4 align-items-center">
        
        <!-- Left: Image + Name -->
        <div class="col-md-4 text-center">
            <img src="{{ asset($principalMsg->image_url) }}" alt="Principal" class="img-fluid rounded-3 shadow" style="max-height: 300px; object-fit: cover;">
            <p class="mt-3 fw-bold text-primary fs-5">{{ $principalMsg->image_name }}</p>
        </div>

        <!-- Right: Message -->
        <div class="col-md-8">
            <h2 class="text-dark fw-semibold mb-3">{{ $principalMsg->image_header }}</h2>
            <p id="principal-message" class="text-muted" style="max-height: 150px; overflow: hidden;">
                {{ $principalMsg->image_description }}
            </p>
            <button id="toggle-button" class="btn btn-outline-primary mt-2" onclick="toggleMessage()">Read more</button>
        </div>

    </div>
</div>

<!-- End of Principal Message -->

<!-- Displaying Events Section -->

@foreach($events as $commonHeader => $group)
<div class="container mb-5">
    <h3 class="text-primary mb-4">{{ $commonHeader }}</h3>

    <div class="position-relative">
        <!-- Optional Scroll Buttons -->
        <button class="scroll-btn left btn btn-light position-absolute top-50 start-0 translate-middle-y z-1" onclick="scrollEvents(this, -1)">&#10094;</button>
        <button class="scroll-btn right btn btn-light position-absolute top-50 end-0 translate-middle-y z-1" onclick="scrollEvents(this, 1)">&#10095;</button>

        <div class="scroll-wrapper d-flex flex-nowrap overflow-auto px-3 py-2" style="scroll-behavior: smooth; gap: 1rem;">
            @php
                $duplicatedEvents = $group->concat($group);
            @endphp

            @foreach($duplicatedEvents as $event)
                <div class="carousel-card card flex-shrink-0 shadow-sm" style="width: 260px; border-radius: 12px;">
                    <div class="overflow-hidden" style="height: 160px; border-top-left-radius: 12px; border-top-right-radius: 12px;">
                        <img src="{{ $event->image_url }}" alt="event"
                             class="img-fluid w-100 h-100" style="object-fit: cover;">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $event->header }}</h5>
                        @if (!empty($event->description))
                            <p class="card-text text-muted small">{{ $event->description }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endforeach

<!-- End of Events Section -->

<!-- Start of the CTAs Section -->

<section class="cta-section">
  <div class="cta-overlay"></div>
  <div class="cta-content">
    <h2>Empowering Education Through Technology</h2>
    <p>Discover a modern learning environment built for students, parents, and teachers. Join us in shaping the future of education at Sree Narayana Vidyaniketan.</p>
    <a href="/admissions" class="cta-button">Apply Now</a>
  </div>
</section>
<!-- End  of the CTAs Section -->


<!-- Start of Quick Stats Teacher, Student -->

<section class="py-5 bg-gradient" style="background: linear-gradient(135deg, #f0f4f8 0%, #d9e8ff 100%);">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h2 class="text-dark fw-bold">Quick Stats</h2>
                <p class="text-muted">Here’s a quick look at what makes our institution stand out.</p>
            </div>
        </div>

        <div class="row justify-content-center">
            @php
                $stats = [
                    ['icon' => 'fa-solid fa-user-graduate', 'count' => '1200+', 'title' => 'Students'],
                    ['icon' => 'fa-solid fa-chalkboard-teacher', 'count' => '85+', 'title' => 'Teachers'],
                    ['icon' => 'fa-solid fa-award', 'count' => '25+', 'title' => 'Years of Excellence'],
                ];
            @endphp

            @foreach($stats as $stat)
                <div class="col-md-4 col-sm-6 mb-4" data-aos="fade-up">
                    <div class="bg-white p-4 rounded-4 shadow-lg h-100 d-flex flex-column align-items-center justify-content-center stat-card hover-shadow transition">
                        <i class="{{ $stat['icon'] }} mb-3" style="font-size: 50px; color: #0f64af;"></i>
                        <h2 class="fw-bold mb-1 count-up" data-count="{{ preg_replace('/[^0-9]/', '', $stat['count']) }}">0</h2>
                        <p class="mb-0 text-muted">{{ $stat['title'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- End of Quick Stats Teacher, Student -->

  <!-- -- News & Events Overlay Image Card -- -->
  <div class="container card news-events">
    <div class="news-container">
      
      {{-- Scrolling images --}}
      
      <div class="news-images">
    @if(!empty($scrollers->slider1))
        <img src="{{ asset($scrollers->slider1) }}" alt="News 1" class="news-image" style="width: 100%; height: 100%; object-fit: cover; object-position: center;" />
    @endif

    @if(!empty($scrollers->slider2))
        <img src="{{ asset($scrollers->slider2) }}" alt="News 2" class="news-image" style="width: 100%; height: 100%; object-fit: cover; object-position: center;" />
    @endif

    @if(!empty($scrollers->slider3))
        <img src="{{ asset($scrollers->slider3) }}" alt="News 3" class="news-image" style="width: 100%; height: 100%; object-fit: cover; object-position: center;" />
    @endif
</div>


      
      {{-- Overlay text --}}
      <div class="news-overlay">
        <p class="news-title">News & Events</p>
      </div>

    </div>
  </div>
</div>




@if($announcements->count())
    <!-- Toggle Button -->
    <button id="toggle-btn" class="blinking-text  btn btn-light position-fixed"  style="top: 120px; right: 20px; z-index: 10000;">
   <a href="#"><i class="fa fa-bell"></i></a>
   <!-- <span>{{ $announcementCount ?? 0 }}</span> -->
    </button>

    <!-- Notification Box -->
    <div id="notification-box" class="notification-box">
        @foreach($announcements as $announcement)
            <div class="blinking-text mb-2" style="border: 2px solid white; min-width: 220px; border-radius: 8px; padding: 10px;">
                <strong>{{ $announcement->header }}</strong><br>
                <p>{{ $announcement->description }}</p>

                @foreach($announcement->files as $file)
                    <div>
                        <a href="{{ $file->file_url }}" download class="text-decoration-underline d-block">
                            📎 Download File
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach

    </div>
    
    <section class="pt-5 pb-5">
    <div class="container">
        <div class="row g-4">
            @php
                $facilities = [
                    ['icon' => 'fa-solid fa-book', 'title' => 'Library', 'color' => '#F4A100'],
                    ['icon' => 'bx bxs-flask', 'title' => 'Labs Facilities', 'color' => '#5C6BC0'],
                    ['icon' => 'fa-solid fa-bus-simple', 'title' => 'Transpotation Facility', 'color' => '#EC407A'],
                    ['icon' => 'fa-solid fa-chalkboard', 'title' => 'Classroom', 'color' => '#AB47BC'],
                    ['icon' => 'fa-solid fa-database', 'title' => 'School Information Center', 'color' => '#29B6F6'],
                    ['icon' => 'bx bx-pray', 'title' => 'Prayer Hall', 'color' => '#FFB74D'],
                    ['icon' => 'fa-solid fa-id-card', 'title' => 'Our Profile', 'color' => '#00BCD4'],
                    ['icon' => 'fa-solid fa-house', 'title' => 'Anthem', 'color' => '#7E57C2'],
                    ['icon' => 'fa-solid fa-hands-praying', 'title' => 'Our Prayer', 'color' => '#A1887F'],
                    ['icon' => 'fa-solid fa-sms', 'title' => 'SMS Facility', 'color' => '#D81B60'],
                    ['icon' => 'fa-solid fa-user-tie', 'title' => 'FACULTY', 'color' => '#EF6C00'],
                    ['icon' => 'fa-solid fa-futbol', 'title' => 'Sports', 'color' => '#26A69A'],
                ];
            @endphp

            @foreach($facilities as $facility)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="d-flex align-items-center border rounded p-3 h-100 facility-card" style="gap: 12px;">
                        <i class="{{ $facility['icon'] }}" style="font-size: 24px; color: {{ $facility['color'] }}"></i>
                        <span class="fw-semibold text-dark">{{ $facility['title'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

    <section id="location-map" style="padding: 40px 0;">
    <div class="map-container" style="margin-top: 40px; margin-bottom: 40px; border: 1px solid #ddd; border-radius: 12px; box-shadow: 0 4px 12px rgba(231, 216, 216, 0.1); padding: 30px; background-color: black;">
        <h2 style="text-align: center; color:white; margin-bottom: 30px;">How to Reach Us?</h2>

        <div style="width: 100%; height: 400px; margin-top: 20px;">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d251382.73388440683!2d76.380997!3d10.110935000000001!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x162afe6ad79d5654!2sSivagiri%20Vidyaniketan!5e0!3m2!1sen!2sin!4v1658994074003!5m2!1sen!2sin"
                width="100%"
                height="100%"
                style="border: 0; border-radius: 10px;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Google Map Embed"
            ></iframe>
        </div>
    </div>
</section>
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
  document.addEventListener('DOMContentLoaded', function () {
    const box = document.getElementById('notification-box');
    const button = document.getElementById('toggle-btn');

    button.addEventListener('click', () => {
      const isHidden = box.style.display === 'none';

      box.style.display = isHidden ? 'block' : 'none';
      button.innerHTML = isHidden
        ? '<i class="fa fa-bell"></i>'
        : '<i class="fa fa-bell-slash"></i>'; // optionally toggle icon
    });
  });
</script>



<!-- Start Quick stats Js file -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    AOS.init({ once: true });

    $('.quick-stats-slider').slick({
        dots: false,
        infinite: true,
        speed: 600,
        slidesToShow: 3,
        arrows: true,
        responsive: [
            { breakpoint: 768, settings: { slidesToShow: 2 }},
            { breakpoint: 480, settings: { slidesToShow: 1 }}
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
    $('.quick-stats-slider').on('afterChange', function () {
        triggerCountOnVisible();
    });
</script>

<!-- End of Quick stats -->

<!-- Events section Button Click -->
<script>
    function scrollEvents(button, direction) {
        const wrapper = button.closest('.position-relative').querySelector('.scroll-wrapper');
        const scrollAmount = 280; // pixels
        wrapper.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
    }
</script>






    @endsection
    
    

    <!-- @section('scripts')
<script src="{{ asset('js/principal-message.js') }}"></script> -->
    
