@extends('layouts.layout')

@section('title', 'Gallery')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet" />
<style>
    .card-gallery {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-gallery:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }
    .sub-gallery, .image-group {
        display: none;
    }
    .img-thumb {
        height: 180px;
        object-fit: cover;
        border-radius: 8px;
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <h2 class="text-center text-primary fw-bold mb-5" data-aos="fade-down">Gallery</h2>

    <div class="row g-4">
        @foreach($galleries as $gallery)
        <div class="col-md-4" data-aos="fade-up">
            <div class="card card-gallery h-100 shadow-sm">
                @if($gallery->main_image)
                <img src="{{ $gallery->main_image }}" class="card-img-top img-thumb" onclick="toggleSubGallery('subgallery-{{ $gallery->id }}')" style="cursor: pointer;">
                @endif
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $gallery->title }}</h5>
                    <button class="btn btn-outline-primary btn-sm" onclick="toggleSubGallery('subgallery-{{ $gallery->id }}')">Explore</button>
                </div>
            </div>
        </div>

        {{-- Subcategories --}}
        <div id="subgallery-{{ $gallery->id }}" class="col-12 sub-gallery">
            <div class="row g-4 mt-3">
                @foreach($gallery->subGalleries as $sub)
                <div class="col-md-4" data-aos="fade-up">
                    <div class="card h-100 shadow-sm">
                        @if($sub->image)
                        <img src="{{ $sub->image }}" class="card-img-top img-thumb" onclick="toggleImageGroup('group-{{ $sub->id }}')" style="cursor:pointer;">
                        @endif
                        <div class="card-body text-center">
                            <h6 class="card-title">{{ $sub->title }}</h6>
                            <button class="btn btn-outline-secondary btn-sm" onclick="toggleImageGroup('group-{{ $sub->id }}')">View Images</button>
                        </div>
                    </div>
                </div>

                {{-- Image Groups --}}
                <div id="group-{{ $sub->id }}" class="col-12 image-group">
                    @foreach($sub->imageGroups as $group)
                    <div class="mt-4">
                        <h6 class="text-muted">{{ $group->title }}</h6>
                        <div class="row g-3">
                            @foreach($group->images as $img)
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center">
                                <a href="{{ $img->image_url }}" class="glightbox" data-gallery="group-{{ $group->id }}" data-title="{{ $img->title ?? '' }}">
                                    <img src="{{ $img->image_url }}" class="img-thumbnail" style="height: 100px; object-fit: cover;">
                                </a>
                                @if($img->title)
                                <p class="small mt-1 text-muted">{{ $img->title }}</p>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
    const lightbox = GLightbox({ selector: '.glightbox' });

    function toggleSubGallery(id) {
        const el = document.getElementById(id);
        if (el) el.style.display = el.style.display === 'block' ? 'none' : 'block';
    }

    function toggleImageGroup(id) {
        const el = document.getElementById(id);
        if (el) el.style.display = el.style.display === 'block' ? 'none' : 'block';
    }
</script>
@endsection
