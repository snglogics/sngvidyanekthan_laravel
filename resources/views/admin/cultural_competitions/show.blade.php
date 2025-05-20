@extends('layouts.admin')

@section('title', 'Cultural Competition Details')
@section('breadcrumb-title', 'Achievements')
@section('breadcrumb-link', route('admin.achievements'))
@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-info text-white rounded-top-4 d-flex align-items-center">
            <i class="bi bi-info-circle-fill me-2 fs-4"></i>
            <h4 class="mb-0">Cultural Competition Details</h4>
        </div>

        <div class="card-body p-4">
            <h3 class="mb-3 text-primary">
                <i class="bi bi-bookmark-star-fill me-2"></i>{{ $culturalCompetition->title }}
            </h3>

            @if($culturalCompetition->image_url)
                <div class="mb-4">
                    <img src="{{ $culturalCompetition->image_url }}"
                         alt="{{ $culturalCompetition->title }}"
                         class="img-fluid rounded shadow-sm"
                         style="max-width: 400px;">
                </div>
            @endif

            <p>
                <i class="bi bi-calendar-event-fill text-success me-2"></i>
                <strong>Year:</strong> {{ $culturalCompetition->competition_year }}
            </p>

            <p>
                <i class="bi bi-card-text text-secondary me-2"></i>
                <strong>Description:</strong><br>
                {{ $culturalCompetition->description }}
            </p>

            <a href="{{ route('admin.cultural_competitions.index') }}"
               class="btn btn-secondary rounded-3 mt-3">
                <i class="bi bi-arrow-left-circle me-1"></i> Back to List
            </a>
        </div>
    </div>
</div>
@endsection
