@extends('layouts.admin')

@section('title', 'Sports & Games')
@section('breadcrumb-title', 'Student Life')
@section('breadcrumb-link', route('admin.studentlife'))

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<style>
    .sport-card {
        transition: all 0.3s ease-in-out;
    }

    .sport-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .sport-image {
        height: 200px;
        object-fit: cover;
    }

    .sport-no-image {
        height: 200px;
        background: linear-gradient(135deg, #6c757d, #adb5bd);
    }

    .sport-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background: linear-gradient(to top, rgba(0,0,0,0.5), transparent);
        color: white;
        height: 100%;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
    }

    .badge {
        font-size: 0.75rem;
        background-color: rgba(255, 255, 255, 0.85);
        padding: 0.4em 0.75em;
        border-radius: 0.5rem;
    }

    .card-title {
        font-size: 1.15rem;
    }
</style>
@endsection


@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4 text-primary">
        <i class="fas fa-futbol"></i> Sports & Games
    </h2>

    <div class="text-end">
        <a href="{{ route('admin.sports_games.create') }}" class="btn btn-success btn-add">
            <i class="fas fa-plus"></i> Add Sports/Game
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mt-4">
    @forelse($sports as $sport)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden position-relative h-100 sport-card">
            <div class="position-relative">
                @if($sport->image_url)
                    <img src="{{ $sport->image_url }}" class="card-img-top sport-image" alt="{{ $sport->title }}">
                @else
                    <div class="sport-no-image d-flex justify-content-center align-items-center">
                        <i class="fas fa-image fa-2x text-light"></i>
                    </div>
                @endif
                <div class="sport-overlay d-flex align-items-end p-3">
                    <span class="badge bg-light text-dark fw-semibold">{{ $sport->category }}</span>
                </div>
            </div>

            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <h5 class="card-title text-primary fw-bold mb-2">
                        <i class="fas fa-trophy me-2"></i> {{ $sport->title }}
                    </h5>
                    <p class="text-muted small mb-3">{{ Str::limit($sport->description, 100) }}</p>
                </div>

                <div class="mb-3">
                    <p class="mb-1"><i class="fas fa-user-tie me-2 text-secondary"></i>Coach: <strong>{{ $sport->coach_name ?? 'N/A' }}</strong></p>
                    <p class="mb-0"><i class="fas fa-phone me-2 text-secondary"></i>Contact: <strong>{{ $sport->contact_number ?? 'N/A' }}</strong></p>
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ route('admin.sports_games.edit', $sport->id) }}" class="btn btn-outline-warning btn-sm">
                        <i class="fas fa-pen me-1"></i> Edit
                    </a>
                    <form action="{{ route('admin.sports_games.destroy', $sport->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger btn-sm w-100">
                            <i class="fas fa-trash me-1"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle me-2"></i> No sports or games found.
        </div>
    </div>
    @endforelse
</div>

</div>
@endsection
