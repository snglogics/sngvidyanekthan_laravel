@extends('layouts.admin')

@section('title', 'Manage Teachers')

@section('styles')
<link href="{{ asset('frontend/css/uploadPrincipal.css') }}" rel="stylesheet">
<style>
    .teacher-card {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

    .teacher-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }

    .teacher-card img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        margin-bottom: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
    }

    .teacher-card h5 {
        color: #007bff;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .teacher-card p {
        color: #555;
        margin-bottom: 5px;
    }

    .teacher-card .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        transition: all 0.3s ease-in-out;
    }

    .teacher-card .btn-warning:hover {
        background-color: #e0a800;
        border-color: #e0a800;
    }

    .teacher-card .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        transition: all 0.3s ease-in-out;
    }

    .teacher-card .btn-danger:hover {
        background-color: #c82333;
        border-color: #c82333;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Teachers</h2>
        <a href="{{ route('teachers.create') }}" class="btn btn-warning btn-sm">Add New</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($teachers as $teacher)
            <div class="col-md-4 mb-4">
                <div class="teacher-card text-center">
                    @if($teacher->photo)
                        <img src="{{ $teacher->photo }}" class="img-fluid mx-auto">
                    @endif
                    <h5>{{ $teacher->name }}</h5>
                    <p class="text-muted">{{ $teacher->designation }}</p>
                    <p>{{ $teacher->experience }} years experience</p>
                    <p><strong>Qualification:</strong> {{ $teacher->qualification ?? 'Not Specified' }}</p>
                    <p><strong>Department:</strong> {{ $teacher->department ?? 'Not Specified' }}</p>
                    <p><strong>Subject:</strong> {{ $teacher->subject ?? 'Not Specified' }}</p>

                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
