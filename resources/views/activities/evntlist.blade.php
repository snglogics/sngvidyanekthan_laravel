@extends('layouts.layout')

@section('title', 'Our Events')

@section('content')
<section class="pt-5 pb-5 bg-light">
    <div class="container">
        <h2 class="text-center text-primary fw-bold mb-5" data-aos="fade-down">Event Gallery</h2>

        @foreach($groupedEvents as $commonHeader => $events)
            <h4 class="text-dark fw-bold mb-4 mt-5">{{ $commonHeader }}</h4>
            <div class="row g-4">
                @foreach($events as $event)
                    <div class="col-md-4 col-sm-6" data-aos="zoom-in">
                        <div class="card shadow-sm border-0 h-100">
                            <img src="{{ $event->image_url }}" class="card-img-top rounded" alt="{{ $event->header }}" style="height: 250px; object-fit: cover;">
                            @if($event->header)
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
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
</script>
@endsection
