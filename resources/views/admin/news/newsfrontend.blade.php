@extends('layouts.layout')

@section('title', 'News')
@section('hero_title', 'Latest News')
@section('content')
<style>
    .parallax-bg {
        background-image: url('/frontend/images/parallel13.jpg');
        background-attachment: fixed;
        background-size: cover;
        background-position: center;
    }
.card {
    background-color: transparent;
    border-radius: 1rem;
    border: 1px solid rgba(255, 255, 255, 0.2); /* Optional: subtle border */
}

    .card-title {
        color: #1e80e2;
        font-weight: bold;
    }
</style>
<div class="parallax-bg">
<div class="container py-5">
   

    <div class="row">
        @forelse($news as $item)
        <div class="col-md-6 mb-4">
            <div class="card shadow-lg border-0">
                @if($item->image_url)
                    <img src="{{ $item->image_url }}" class="card-img-top" style="max-height: 200px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $item->title }}</h5>
                    <p class="card-text">{{ Str::limit($item->content, 150) }}</p>

                  @if($item->youtube_link)
    <div class="ratio ratio-16x9 mb-2">
        <iframe 
            src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::after($item->youtube_link, 'v=') }}" 
            frameborder="0" allowfullscreen>
        </iframe>
    </div>
    <p>
        <a href="{{ $item->youtube_link }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-primary">
            Watch on YouTube
        </a>
    </p>
@endif
                </div>
            </div>
        </div>
        @empty
        <p class="text-white text-center">No news available.</p>
        @endforelse
    </div>
</div>
</div>
@endsection
