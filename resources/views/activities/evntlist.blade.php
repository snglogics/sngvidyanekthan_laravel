@extends('layouts.layout')

@section('title', 'Our Events')
@section('styles')
    <style>
        .modal {
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            max-width: 90%;
            max-height: 90%;
            border-radius: 10px;
        }

        .close {
            position: absolute;
            top: 30px;
            right: 50px;
            color: white;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            z-index: 1060;
        }
    </style>
@endsection
@section('hero_title', 'Event Gallery')

@section('content')
    <section class="pt-5 pb-5 bg-light">
        <div class="container">

            @foreach ($groupedEvents as $commonHeader => $events)
                <h4 class="text-dark fw-bold mb-4 mt-5">{{ $commonHeader }}</h4>
                <div class="row g-4">
                    @foreach ($events as $event)
                        <div class="col-md-4 col-sm-6" data-aos="zoom-in">
                            <div class="card shadow-sm border-0 h-100">
                                <img src="{{ $event->image_url }}" class="card-img-top rounded" alt="{{ $event->header }}"
                                    style="height: 250px; object-fit: cover; cursor: pointer;"
                                    onclick="openModal('{{ $event->image_url }}')">
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
    <div id="imageModal" class="modal" onclick="closeModal()" style="display:none;">
        <span class="close" onclick="closeModal()" style="color: white;">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
    <script>
        function openModal(imageSrc) {
            document.getElementById("modalImage").src = imageSrc;
            document.getElementById("imageModal").style.display = "flex";
        }

        function closeModal() {
            document.getElementById("imageModal").style.display = "none";
        }

        // Optional: close modal when clicking outside image
        document.getElementById("imageModal").addEventListener("click", function(event) {
            if (event.target.id === "imageModal") {
                closeModal();
            }
        });
    </script>

@endsection
