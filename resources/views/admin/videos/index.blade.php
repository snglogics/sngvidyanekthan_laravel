@extends('layouts.admin')

@section('title', 'Manage Announcements')


@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
@endsection

@section('content')
<section class="pt-5 pb-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold text-primary mb-5" data-aos="fade-down">Video Albums</h2>

        <div class="row">
            @foreach($videos->where('type', 'album') as $video)
            <div class="video-card">
    <div class="video-title">{{ $video->title }}</div>

    <video controls width="100%" class="led-video">
        <source src="{{ $video->video_url }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <form action="{{ route('admin.videos.destroy', $video->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this video?')" class="mt-2 text-center">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger mt-2">
            <i class="fas fa-trash"></i> Delete
        </button>
    </form>
</div>
            @endforeach
        </div>

        <h2 class="text-center fw-bold text-primary mt-5 mb-4" data-aos="fade-down">360° Virtual Tours</h2>

        <div class="row">
            @foreach($videos->where('type', 'virtual') as $video)
            <div class="col-md-6 mb-4" data-aos="fade-up">
    <div class="video-card">
        <div class="video-title">{{ $video->title }}</div>

        <video controls width="100%" class="led-video">
            <source src="{{ $video->video_url }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <form action="{{ route('admin.videos.destroy', $video->id) }}" method="POST" 
              onsubmit="return confirm('Are you sure you want to delete this video?')" 
              class="mt-2 text-center">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger mt-2">
                <i class="fas fa-trash"></i> Delete
            </button>
        </form>
    </div>
</div>

            @endforeach
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.js"></script>
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
