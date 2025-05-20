@extends('layouts.admin')

@section('title', 'Campus Overviews')
@section('breadcrumb-title', 'About')
@section('breadcrumb-link', route('admin.about'))

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
    .card:hover {
        transform: translateY(-5px);
        transition: 0.3s;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .btn-icon {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .card-img-top {
        border-radius: 0.5rem;
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary fw-bold"><i class="bi bi-building"></i> Campus Overviews</h2>
        <a href="{{ route('admin.campus-overviews.create') }}" class="btn btn-success btn-icon">
            <i class="bi bi-plus-circle"></i> Add New Overview
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        @forelse($overviews as $overview)
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    @if(!empty($overview->photos) && is_array($overview->photos))
                        <img src="{{ is_array($overview->photos[0]) ? $overview->photos[0]['url'] : $overview->photos[0] }}"
                             class="card-img-top mb-2"
                             alt="Overview Photo"
                             style="height: 200px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/400x200?text=No+Image" 
                             class="card-img-top mb-2"
                             alt="No Image">
                    @endif

                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title text-primary">
                                <i class="bi bi-info-circle-fill me-1"></i>{{ $overview->main_heading }}
                            </h5>
                            <p class="card-text text-muted">{{ Str::limit($overview->description, 150) }}</p>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('admin.campus-overviews.show', $overview->id) }}" class="btn btn-outline-info btn-sm btn-icon">
                                <i class="bi bi-eye"></i> View
                            </a>
                            <a href="{{ route('admin.campus-overviews.edit', $overview->id) }}" class="btn btn-outline-warning btn-sm btn-icon">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('admin.campus-overviews.destroy', $overview->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this overview?')" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm btn-icon">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle-fill me-1"></i>
                    No campus overviews found. Click the "Add New Overview" button above to create one.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
