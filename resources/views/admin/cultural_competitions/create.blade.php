@extends('layouts.admin')

@section('title', 'Add Cultural Competition')
@section('breadcrumb-title', 'Achievements')
@section('breadcrumb-link', route('admin.achievements'))
@section ('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4 d-flex align-items-center">
            <i class="bi bi-award-fill me-2 fs-4"></i>
            <h4 class="mb-0">Add Cultural Competition</h4>
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

            <form action="{{ route('admin.cultural_competitions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Title --}}
                <div class="mb-4">
                    <label for="title" class="form-label fw-semibold">
                        <i class="bi bi-bookmark-star-fill text-primary me-1"></i> Title
                    </label>
                    <input type="text" name="title" id="title" class="form-control rounded-3 shadow-sm" required placeholder="Eg: National Level Dance Competition">
                </div>

                {{-- Competition Year --}}
                <div class="mb-4">
                    <label for="competition_year" class="form-label fw-semibold">
                        <i class="bi bi-calendar-event-fill text-success me-1"></i> Competition Year
                    </label>
                    <input type="text" name="competition_year" id="competition_year" class="form-control rounded-3 shadow-sm" required placeholder="Eg: 2024-25">
                </div>

                {{-- Description --}}
                <div class="mb-4">
                    <label for="description" class="form-label fw-semibold">
                        <i class="bi bi-card-text text-warning me-1"></i> Description
                    </label>
                    <textarea name="description" id="description" class="form-control rounded-3 shadow-sm" rows="4" placeholder="Briefly describe the event..."></textarea>
                </div>

                {{-- Image Upload --}}
                <div class="mb-4">
                    <label for="image" class="form-label fw-semibold">
                        <i class="bi bi-image-fill text-danger me-1"></i> Upload Image
                    </label>
                    <input type="file" name="image" id="image" class="form-control rounded-3 shadow-sm">
                    <small class="text-muted ms-1"><i class="bi bi-info-circle"></i> Accepted formats: jpg, png, gif. Max size: 2MB.</small>
                </div>

                {{-- Submit Button --}}
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4 py-2 rounded-3 shadow-sm">
                        <i class="bi bi-plus-circle-fill me-2"></i> Add Competition
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
