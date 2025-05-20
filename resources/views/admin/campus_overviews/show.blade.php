@extends('layouts.admin')

@section('title', $campusOverview->main_heading)
@section('breadcrumb-title', 'About')
@section('breadcrumb-link', route('admin.about'))

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
  .card-img-top {
      transition: transform 0.3s ease;
  }
  .card-img-top:hover {
      transform: scale(1.05);
  }
</style>

@endsection

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">
            <i class="bi bi-buildings me-2 text-primary"></i>
            {{ $campusOverview->main_heading }}
        </h2>
        <p class="text-muted mt-3 fs-5">{{ $campusOverview->description }}</p>
    </div>

    <div class="row g-4">
        @forelse($campusOverview->photos as $photo)
            <div class="col-md-4">
                <div class="card shadow-sm h-100 border-0">
                    <img src="{{ $photo['url'] }}" class="card-img-top rounded-top" alt="Campus Photo">
                    <div class="card-body text-center">
                        @if(!empty($photo['title']))
                            <h6 class="card-title text-primary">
                                <i class="bi bi-camera-fill me-1"></i>{{ $photo['title'] }}
                            </h6>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">
                    <i class="bi bi-exclamation-circle me-2"></i>No photos available.
                </p>
            </div>
        @endforelse
    </div>
</div>
@endsection
