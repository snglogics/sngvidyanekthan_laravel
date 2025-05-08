@extends('layouts.layout')
@section('title', $magazine->title ?? 'Magazine')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center text-primary">{{ $magazine->title }}</h2>

    <div class="flipbook-container shadow rounded overflow-hidden">
        <iframe src="https://docs.google.com/gview?url={{ urlencode($magazine->pdf_url) }}&embedded=true"
                width="100%" height="600px" frameborder="0"></iframe>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true
    });
</script>
@endsection
