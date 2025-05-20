@extends('layouts.admin')

@section('title', 'Manage Announcements')
@section('breadcrumb-title', 'Gallery')
@section('breadcrumb-link', route('admin.galleries'))

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.css" rel="stylesheet" />
<style>
    .video-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        padding: 1rem;
        margin-bottom: 2rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .video-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 25px rgba(0,0,0,0.15);
    }

    .video-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 0.75rem;
        text-align: center;
    }

    video.led-video {
        border-radius: 10px;
        max-height: 240px;
        object-fit: cover;
    }
</style>
@endsection

@section('content')
<section class="pt-5 pb-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold text-primary mb-5" data-aos="fade-down">
    Video Albums
</h2>

<div class="row">
    @php $albumVideos = $videos->where('type', 'album'); @endphp
    @if($albumVideos->isEmpty())
        <div class="col-12 text-center text-muted mb-4" data-aos="fade-up">
            <p>No video albums available.</p>
        </div>
    @else
        @foreach($albumVideos as $video)
        <div class="col-md-4" data-aos="zoom-in">
            <div class="video-card h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="video-title">{{ $video->title }}</div>
                    <video controls class="led-video w-100">
                        <source src="{{ $video->video_url }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <form action="{{ route('admin.videos.destroy', $video->id) }}" method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this video?')" 
                      class="mt-3 text-center">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger w-100">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    @endif
</div>

        <h2 class="text-center fw-bold text-primary mt-5 mb-4" data-aos="fade-down">
    360° Virtual Tours
</h2>

<div class="row">
    @php $virtualVideos = $videos->where('type', 'virtual'); @endphp
    @if($virtualVideos->isEmpty())
        <div class="col-12 text-center text-muted mb-4" data-aos="fade-up">
            <p>No 360° virtual tours available.</p>
        </div>
    @else
        @foreach($virtualVideos as $video)
        <div class="col-md-6 mb-4" data-aos="fade-up">
            <div class="video-card h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="video-title">{{ $video->title }}</div>
                    <video controls class="led-video w-100">
                        <source src="{{ $video->video_url }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <form action="{{ route('admin.videos.destroy', $video->id) }}" method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this video?')" 
                      class="mt-3 text-center">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger w-100">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    @endif
</div>

    </div>
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
</script>

@if(session('success'))
    <script>toastr.success("{{ session('success') }}")</script>
@endif

@if(session('error'))
    <script>toastr.error("{{ session('error') }}")</script>
@endif
@endsection
