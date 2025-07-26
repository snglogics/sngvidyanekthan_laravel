@extends('layouts.layout')

@section('title', 'Video Gallery')
@section('hero_title', 'Video Albums')

@section('styles')
    <style>
        .video-card {
            background: linear-gradient(to top right, #f8f9fa, #e9ecef);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            position: relative;
        }

        .video-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        }

        .video-title {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            padding: 15px;
            font-size: 1.25rem;
            text-align: center;
        }

        .led-video {
            border-top: 2px solid #007bff;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }

        .no-videos {
            text-align: center;
            font-size: 1.2rem;
            font-weight: 500;
            color: #888;
            padding: 40px 0;
        }
    </style>
@endsection

@section('content')
    <section class="pt-5 pb-5 bg-light">
        <div class="container">
            @if ($videos->where('type', 'album')->isNotEmpty())
                <h2 class="text-center fw-bold text-primary mb-5" data-aos="fade-down">Video Albums</h2>

                <div class="row">
                    @foreach ($videos->where('type', 'album') as $video)
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
            @else
                <div class="row">
                    <div class="col-12">
                        <div class="no-videos" data-aos="fade-up">No Video Albums Available</div>
                    </div>
                </div>
            @endif


            @if ($videos->where('type', 'virtual')->isNotEmpty())
                <h2 class="text-center fw-bold text-primary mt-5 mb-4" data-aos="fade-down">360° Virtual Tours</h2>

                <div class="row">
                    @foreach ($videos->where('type', 'virtual') as $video)
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
            @else
                <div class="row">
                    <div class="col-12">
                        <div class="no-videos" data-aos="fade-up">No 360° Virtual Tours Available</div>
                    </div>
                </div>
            @endif

            <h2 class="text-center fw-bold text-danger mt-5 mb-4" data-aos="fade-down">Our YouTube Channel</h2>

            <!-- <div class="row">
                @forelse($youtubeVideos as $video)
                    @if (isset($video['id']['videoId']))
                        <div class="col-md-4 mb-4" data-aos="fade-up">
                            <div class="video-card">
                                <div
                                    class="video-title bg-danger text-white d-flex align-items-center justify-content-center">
                                    <i class="bi bi-youtube me-2 fs-5"></i> {{ $video['snippet']['title'] }}
                                </div>
                                <iframe class="led-video" width="100%" height="315"
                                    src="https://www.youtube.com/embed/{{ $video['id']['videoId'] }}" title="YouTube video"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="col-12">
                        <div class="no-videos" data-aos="fade-up">No YouTube Videos Found</div>
                    </div>
                @endforelse
            </div> -->


        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
@endsection
