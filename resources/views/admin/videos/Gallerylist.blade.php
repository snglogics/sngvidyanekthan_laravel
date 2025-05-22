@extends('layouts.layout')

@section('title', 'Gallery')
@section('hero_title', 'Gallery')
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
    

    <div class="row g-4">
    @foreach($galleries as $gallery)
        <div class="col-md-6 col-lg-4">
            <div class="text-center">
                <h3 class="text-primary mb-3">{{ $gallery->title }}</h3>

                @if($gallery->main_image)
                    <div class="card border-0 shadow-sm rounded-4 h-100 card-gallery">
                        <img src="{{ $gallery->main_image }}" class="img-fluid rounded-top" alt="{{ $gallery->title }}" style="height: 220px; object-fit: cover;">
                        <div class="card-body">
                            <a href="{{ route('gallery.subgalleries', $gallery->id) }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-folder-open me-1"></i> Explore
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
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
