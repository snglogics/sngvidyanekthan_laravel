@extends('layouts.layout')
@section('styles')
    <style>
        /* Priciple  Message*/
        .principal-section.container {
            padding: 20px 20px;
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

        /* kinder Gallery */
        .gallery-container {
            padding: 30px;
        }

        .gallery-group {
            margin-bottom: 40px;
        }

        .gallery-header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .gallery-images {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .gallery-image {
            width: 200px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 8px;
            background: #f9f9f9;
            text-align: center;
            align-items: center;
        }

        .gallery-image img {
            width: 100%;
            height: auto;
            border-radius: 4px;
        }

        .image-caption {
            font-size: 14px;
            margin-top: 5px;
            color: #555;
        }
    </style>
@endsection
@section('title', 'Kinder Home')
@section('content')
    <section id="kinder-slider-part" class="slider-active">
        @foreach ($kinderSliders as $slider)
            <div class="single-slider bg_cover pt-150" style="background-image: url('{{ $slider->image_url }}')"
                data-overlay="4">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-7 col-lg-9">
                            <div class="slider-cont">
                                <h1 data-animation="bounceInLeft" data-delay="1s">{{ $slider->header ?? '' }}</h1>
                                <p data-animation="fadeInUp" data-delay="1.3s">{{ $slider->description ?? '' }}</p>
                                <ul>
                                    <li><a data-animation="fadeInUp" data-delay="1.6s" class="main-btn"
                                            href="{{ route('about') }}">Read More</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>

    {{-- Principal message --}}

    <div class="container principal-section">
        <div class="principal-quote-container">
            <div class="principal-image-container">
                <img src="{{ asset($principalMsg->image_url) }}" alt="Principal">
                <p class="principal-name">{{ $principalMsg->image_name }}</p>
            </div>
            <p id="principal-message" class="principal-quote">
                {{ $principalMsg->description }}
            </p>
        </div>
    </div>


    {{-- Kinder Gallery --}}
    <div class="gallery-container">
        @foreach ($kinderGallery as $header => $images)
            <div class="gallery-group">
                <h2 class="gallery-header">{{ $header }}</h2>
                <div class="gallery-images d-flex flex-wrap justify-content-center gap-3">
                    @foreach ($images as $image)
                        <div class="gallery-image" style="cursor: pointer;" data-bs-toggle="modal"
                            data-bs-target="#imageModal" data-image="{{ $image->image_url }}">
                            <img src="{{ $image->image_url }}" alt="Kinder Image" width="150" class="img-thumbnail">
                            @if ($image->header)
                                <p class="image-caption">{{ $image->header }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content bg-transparent border-0 position-relative">
                <div class="modal-body text-center p-0">
                    <!-- Close Button -->
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"
                        aria-label="Close"></button>

                    <img id="modalImage" src="" class="img-fluid rounded shadow" alt="Expanded Image">
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    {{-- <script>
        const principalMessageText = @json($principalMsg->description);
    </script>
    <script src="{{ asset('frontend/js/principal-message.js') }}"></script> --}}

    <script>
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');

        modal.addEventListener('show.bs.modal', function(event) {
            const trigger = event.relatedTarget;
            const imageUrl = trigger.getAttribute('data-image');
            modalImage.src = imageUrl;
        });
    </script>
@endsection
