@extends('layouts.admin')

@section('title', 'Edit Cultural Competition')
@section('breadcrumb-title', 'Achievements')
@section('breadcrumb-link', route('admin.achievements'))
@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection
@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-warning text-dark rounded-top-4 d-flex align-items-center">
            <i class="bi bi-pencil-square me-2 fs-4"></i>
            <h4 class="mb-0">Edit Cultural Competition</h4>
        </div>

        <div class="card-body p-4">
            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="alert alert-danger rounded-3">
                    <h5><i class="bi bi-exclamation-triangle-fill"></i> Please fix the following:</h5>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li><i class="bi bi-dot"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.cultural_competitions.update', $culturalCompetition->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Title --}}
                <div class="mb-4">
                    <label for="title" class="form-label fw-semibold">
                        <i class="bi bi-bookmark-star-fill text-primary me-1"></i> Title
                    </label>
                    <input type="text" name="title" id="title" class="form-control rounded-3 shadow-sm"
                           value="{{ $culturalCompetition->title }}" required>
                </div>

                {{-- Competition Year --}}
                <div class="mb-4">
                    <label for="competition_year" class="form-label fw-semibold">
                        <i class="bi bi-calendar-event-fill text-success me-1"></i> Competition Year
                    </label>
                    <input type="text" name="competition_year" id="competition_year" class="form-control rounded-3 shadow-sm"
                           value="{{ $culturalCompetition->competition_year }}" required>
                </div>

                {{-- Description --}}
                <div class="mb-4">
                    <label for="description" class="form-label fw-semibold">
                        <i class="bi bi-card-text text-warning me-1"></i> Description
                    </label>
                    <textarea name="description" id="description" class="form-control rounded-3 shadow-sm"
                              rows="4" placeholder="Update the competition details...">{{ $culturalCompetition->description }}</textarea>
                </div>

                {{-- Image Upload --}}
                <div class="mb-4">
                    <label for="image" class="form-label fw-semibold">
                        <i class="bi bi-image-fill text-danger me-1"></i> Update Image
                    </label>
                    @if($culturalCompetition->image_url)
                        <div class="mb-2">
                            <img src="{{ $culturalCompetition->image_url }}" alt="{{ $culturalCompetition->title }}"
                                 class="img-thumbnail rounded-3" width="150">
                        </div>
                    @endif
                    <input type="file" name="image" id="image" class="form-control rounded-3 shadow-sm">
                    <small class="text-muted"><i class="bi bi-info-circle"></i> Leave empty to keep existing image.</small>
                </div>

                {{-- Submit Button --}}
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4 py-2 rounded-3 shadow-sm">
                        <i class="bi bi-save2-fill me-2"></i> Update Competition
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
