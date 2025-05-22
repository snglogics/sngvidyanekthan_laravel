<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SNG VidyaNikethan')</title>

    
    <!-- Global Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="{{ asset('frontend/css/schoolinfo.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/css/vision.css') }}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.7/main.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.7/main.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
<style>
     .campus-hero {
        background: url('/frontend/images/campusImg.jpg') no-repeat center center/cover;
        color: #fff;
        padding: 100px 0;
        text-align: center;
        position: relative;
        box-sizing: border-box;
        
    }

    .campus-hero::before {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
    }

    .campus-hero h1 {
    position: relative;
    font-size: 3rem;
    font-weight: 700;
    z-index: 1;
    color: white;

    /* Gradient fill */
    background: linear-gradient(to right, rgb(39, 94, 212), #0ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;

    /* Glow effect */
    text-shadow:
        0 0 5px rgba(0, 140, 255, 0.7),
        0 0 10px rgba(0, 255, 106, 0.6),
        0 0 20px rgba(255, 255, 255, 0.5);

    animation: shine 2s infinite linear;
}

/* Optional: Add subtle border-like illusion */


    </style>

   <style>
@keyframes heroAnimation {
    0% {
        transform: translateX(0);
    }
    30% {
        transform: translateX(-50%); /* Move completely left */
    }
    40% {
        transform: translateX(100%); /* Move completely right */
    }
    60% {
        transform: translateX(0); /* Back to center */
    }
    65% {
        transform: translateX(-10px);
    }
    70% {
        transform: translateX(10px);
    }
    75% {
        transform: translateX(-5px);
    }
    80% {
        transform: translateX(5px);
    }
    85% {
        transform: translateX(-2px);
    }
    90% {
        transform: translateX(2px);
    }
    100% {
        transform: translateX(0);
    }
}

.campus-hero h1 {
    animation: heroAnimation 6s ease-in-out forwards;
}

.principal-name {
    font-size: 2rem;
    color: white;
    background: linear-gradient(to right, #00f, #0ff);
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

 <!-- Page Specific Styles -->
    @yield('styles')
    
</head>
<body>
    <nav>
        @include('navbar')
    </nav>
    @if(View::hasSection('hero_title'))
    <div class="campus-hero">
        <h1> @yield('hero_title')</h1>
    </div>
@endif

    <div >
        @yield('content')
    </div>
    <Footer>
        @include('footer')
</Footer>
        @yield('scripts')   
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>   
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true,
    });
</script>  
</body>
</html>