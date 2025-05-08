@extends('layouts.layout')

@section('title', 'Our Teachers')

@section('content')
<section class="pt-5 pb-5 bg-light">
    <div class="container">
        <h2 class="text-center text-primary fw-bold mb-5" data-aos="fade-down">Meet Our Teachers</h2>

        <div class="row">
            @foreach($teachers as $teacher)
            <div class="col-md-4 mb-4" data-aos="fade-up">
                <div class="card h-100 border-0 shadow-sm p-3 text-center">
                    <div class="mb-3">
                        <img src="{{ $teacher->photo }}" alt="{{ $teacher->name }}"
                             class="rounded-circle mx-auto"
                             style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #0f64af;">
                    </div>
                    <h5 class="fw-bold text-dark">{{ $teacher->name }}</h5>
                    <p class="text-muted mb-1">{{ $teacher->designation }}</p>
                    <p class="text-secondary">{{ $teacher->experience }} years experience</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
</script>
@endsection
