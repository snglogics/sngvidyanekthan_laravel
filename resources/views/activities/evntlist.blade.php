@extends('layouts.layout')

@section('title', 'Our Events')
@section('styles')
    <style>
        /* Modal Styles */
        .modal {
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.95);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 0;
            margin: 0;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            width: auto;
            height: auto;
            max-width: 100vw;
            max-height: 100vh;
            object-fit: contain;
            display: block;
        }

        .close {
            position: fixed;
            top: 20px;
            right: 30px;
            color: white;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            z-index: 1060;
            background: rgba(0, 0, 0, 0.5);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            border: none;
        }

        .close:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }

        /* Gallery Styles */
        .pt-5 {
            padding-top: 3rem !important;
        }

        .pb-5 {
            padding-bottom: 3rem !important;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        .card {
            transition: all 0.3s ease;
            overflow: hidden;
            border: none !important;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
        }

        .card-img-top {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .card:hover .card-img-top {
            transform: scale(1.05);
        }

        .card-body {
            padding: 1rem;
            background: white;
        }

        /* Loading state for modal */
        .modal-loading {
            color: white;
            font-size: 1.5rem;
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .modal.loading .modal-loading {
            display: block;
        }

        .modal.loading .modal-content {
            opacity: 0;
        }

        /* Navigation arrows */
        .nav-arrow {
            position: fixed;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            font-size: 35px;
            cursor: pointer;
            z-index: 1060;
            background: rgba(0, 0, 0, 0.5);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            border: none;
        }

        .nav-arrow:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-50%) scale(1.1);
        }

        .nav-arrow.prev {
            left: 30px;
        }

        .nav-arrow.next {
            right: 30px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .close {
                top: 15px;
                right: 20px;
                font-size: 35px;
                width: 45px;
                height: 45px;
            }

            .nav-arrow {
                font-size: 25px;
                width: 40px;
                height: 40px;
            }

            .nav-arrow.prev {
                left: 15px;
            }

            .nav-arrow.next {
                right: 15px;
            }
        }

        @media (max-width: 576px) {
            .close {
                top: 10px;
                right: 15px;
                font-size: 30px;
                width: 40px;
                height: 40px;
            }

            .nav-arrow {
                font-size: 20px;
                width: 35px;
                height: 35px;
            }
        }

        /* Ensure images in gallery maintain aspect ratio */
        .card-img-top {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        /* Image grid improvements */
        .row.g-4 {
            margin-bottom: 2rem;
        }

        .col-md-4 {
            margin-bottom: 1.5rem;
        }
    </style>
@endsection

@section('hero_title', 'Event Gallery')

@section('content')
    <section class="pt-5 pb-5 bg-light">
        <div class="container">
            @foreach ($groupedEvents as $commonHeader => $events)
                <div class="mb-3">
                    <h4 class="text-dark fw-bold mb-1 mt-5">
                        <i class="fas fa-folder-open me-2"></i>{{ $commonHeader }}
                    </h4>

                    @if (optional($events->first())->description)
                        <p class="text-muted">{{ $events->first()->description }}</p>
                    @endif
                </div>
                <div class="row g-4">
                    @foreach ($events as $event)
                        <div class="col-md-4 col-sm-6" data-aos="zoom-in">
                            <div class="card shadow-sm border-0 h-100">
                                <img src="{{ $event->image_url }}" 
                                     class="card-img-top rounded" 
                                     alt="{{ $event->header }}"
                                     data-src="{{ $event->image_url }}"
                                     data-caption="{{ $event->header }}"
                                     onclick="openModal(this)">
                                @if ($event->header)
                                    <div class="card-body text-center">
                                        <p class="fw-semibold mb-0">{{ $event->header }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>

    <!-- Image Modal -->
    <div id="imageModal" class="modal" onclick="closeModal(event)">
        <span class="close" onclick="closeModal(event)">&times;</span>
        
        <!-- Navigation Arrows -->
        <button class="nav-arrow prev" onclick="navigateModal(-1, event)">
            <i class="fas fa-chevron-left"></i>
        </button>
        
        <button class="nav-arrow next" onclick="navigateModal(1, event)">
            <i class="fas fa-chevron-right"></i>
        </button>

        <!-- Loading Indicator -->
        <div class="modal-loading">
            <i class="fas fa-spinner fa-spin"></i>
        </div>

        <!-- Modal Image -->
        <img class="modal-content" id="modalImage" onload="imageLoaded()" onerror="imageError()">
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
        });

        // Global variables
        let currentImageIndex = 0;
        let allImages = [];

        // Collect all images from the page
        function collectAllImages() {
            allImages = Array.from(document.querySelectorAll('.card-img-top')).map(img => ({
                src: img.dataset.src,
                caption: img.dataset.caption
            }));
        }

        // Open modal with clicked image
        function openModal(clickedImage) {
            collectAllImages();
            
            // Find clicked image index
            const clickedSrc = clickedImage.dataset.src;
            currentImageIndex = allImages.findIndex(img => img.src === clickedSrc);
            
            if (currentImageIndex === -1) currentImageIndex = 0;
            
            // Show loading state
            const modal = document.getElementById("imageModal");
            modal.classList.add('loading', 'active');
            
            // Load image
            const modalImage = document.getElementById("modalImage");
            modalImage.src = allImages[currentImageIndex].src;
            
            // Prevent body scroll
            document.body.style.overflow = "hidden";
            document.body.style.height = "100vh";
        }

        // Close modal
        function closeModal(event) {
            if (event) {
                event.stopPropagation();
                // Only close if clicking on modal background or close button
                if (event.target.id === 'imageModal' || event.target.classList.contains('close')) {
                    const modal = document.getElementById("imageModal");
                    modal.classList.remove("active", "loading");
                    
                    // Reset body styles
                    document.body.style.overflow = "auto";
                    document.body.style.height = "auto";
                    
                    // Reset image source
                    setTimeout(() => {
                        document.getElementById("modalImage").src = "";
                    }, 300);
                }
            }
        }

        // Navigate between images
        function navigateModal(direction, event) {
            if (event) event.stopPropagation();
            
            currentImageIndex += direction;
            
            // Loop around
            if (currentImageIndex < 0) {
                currentImageIndex = allImages.length - 1;
            } else if (currentImageIndex >= allImages.length) {
                currentImageIndex = 0;
            }
            
            // Show loading and load new image
            const modal = document.getElementById("imageModal");
            modal.classList.add('loading');
            
            const modalImage = document.getElementById("modalImage");
            modalImage.src = allImages[currentImageIndex].src;
        }

        // Hide loading when image is loaded
        function imageLoaded() {
            const modal = document.getElementById("imageModal");
            const modalImage = document.getElementById("modalImage");
            
            modal.classList.remove('loading');
            modalImage.style.opacity = "1";
            
            // Force reflow to ensure proper display
            modalImage.style.display = 'none';
            modalImage.offsetHeight; // Trigger reflow
            modalImage.style.display = 'block';
        }

        // Handle image loading errors
        function imageError() {
            const modal = document.getElementById("imageModal");
            modal.classList.remove('loading');
            console.error('Failed to load image');
        }

        // Keyboard navigation
        document.addEventListener('keydown', function(event) {
            const modal = document.getElementById("imageModal");
            if (!modal.classList.contains('active')) return;
            
            switch(event.key) {
                case 'Escape':
                    closeModal(event);
                    break;
                case 'ArrowLeft':
                    navigateModal(-1);
                    break;
                case 'ArrowRight':
                    navigateModal(1);
                    break;
            }
        });

        // Touch swipe support for mobile
        let touchStartX = 0;
        let touchEndX = 0;

        document.getElementById('imageModal').addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        }, false);

        document.getElementById('imageModal').addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, false);

        function handleSwipe() {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;
            
            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    // Swipe left - next image
                    navigateModal(1);
                } else {
                    // Swipe right - previous image
                    navigateModal(-1);
                }
            }
        }

        // Preload images for better performance
        function preloadImages() {
            collectAllImages();
            allImages.forEach(imgData => {
                const img = new Image();
                img.src = imgData.src;
            });
        }

        // Preload images when page loads
        window.addEventListener('load', preloadImages);
    </script>
@endsection