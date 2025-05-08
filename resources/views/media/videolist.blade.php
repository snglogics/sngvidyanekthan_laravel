@extends('layouts.layout')

@section('title', 'Video Gallery')



@section('content')
<section class="pt-5 pb-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold text-primary mb-5" data-aos="fade-down">Video Albums</h2>

        <div class="row">
            @foreach($videos->where('type', 'album') as $video)
                <div class="col-md-6 mb-4" data-aos="fade-up">
                    <div class="video-card">
                        <div class="video-title">{{ $video->title }}</div>
                        <video controls width="100%" class="led-video">
                            <source src="{{ $video->video_url }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
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
                        </video>
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
@endsection
