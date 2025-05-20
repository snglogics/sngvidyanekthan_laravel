@extends('layouts.admin')

@section('title', 'Manage Teachers')
@section('breadcrumb-title', 'Faculty')
@section('breadcrumb-link', route('admin.faculties'))

@section('styles')
<link href="{{ asset('frontend/css/uploadPrincipal.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    .teacher-card {
        background: #ffffff;
        border-radius: 15px;
        padding: 25px;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    .teacher-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .teacher-card img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 15px;
        border: 3px solid #007bff;
    }

    .teacher-card h5 {
        font-size: 1.2rem;
        color: #007bff;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .teacher-card p {
        margin-bottom: 5px;
        color: #6c757d;
    }

    .card-actions a,
    .card-actions form button {
        min-width: 85px;
    }

    .btn-sm i {
        margin-right: 5px;
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529;
    }

    .btn-warning:hover {
        background-color: #e0a800;
        border-color: #d39e00;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Teachers</h2>
        <a href="{{ route('teachers.create') }}" class="btn btn-warning btn-sm">
            <i class="fas fa-user-plus"></i> Add New
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        @forelse($teachers as $teacher)
            <div class="col-12 mb-4">
                <div class="card shadow-sm border-0 p-3">
                    <div class="row g-0 align-items-center">
                        <div class="col-md-2 text-center">
                            <img src="{{ $teacher->photo ?? asset('images/default-avatar.png') }}" class="img-fluid rounded-circle border border-primary" style="width: 100px; height: 100px; object-fit: cover;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title text-primary fw-bold mb-1">{{ $teacher->name }}</h5>
                                <p class="mb-1"><i class="fas fa-briefcase me-2 text-secondary"></i>{{ $teacher->experience }} years experience</p>
                                <p class="mb-1"><i class="fas fa-user-graduate me-2 text-secondary"></i><strong>Qualification:</strong> {{ $teacher->qualification ?? 'Not Specified' }}</p>
                                <p class="mb-1"><i class="fas fa-building me-2 text-secondary"></i><strong>Department:</strong> {{ $teacher->department ?? 'Not Specified' }}</p>
                                <p class="mb-1"><i class="fas fa-book me-2 text-secondary"></i><strong>Subject:</strong> {{ $teacher->subject ?? 'Not Specified' }}</p>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex flex-column align-items-center justify-content-center gap-2">
                            <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-sm btn-outline-warning w-100">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this teacher?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger w-100">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">No teachers found.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection
