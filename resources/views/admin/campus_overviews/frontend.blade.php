@extends('layouts.layout')

@section('title', 'Campus Overview')

@section('styles')

<style>
   
</style>
@endsection

@section('content')
<div class="container py-5">
    <h2 class="text-center text-primary fw-bold mb-5" data-aos="fade-down">Campus Overview</h2>
    <div class="row">
        @foreach($campusOverviews as $overview)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="campus-card">
                    <img src="{{ $overview->main_image_url }}" alt="{{ $overview->main_heading }}">
                    <div class="campus-card-body">
                        <h4 class="campus-card-title">{{ $overview->main_heading }}</h4>
                        <p class="campus-card-description">{{ $overview->description }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
</script>
@endsection
