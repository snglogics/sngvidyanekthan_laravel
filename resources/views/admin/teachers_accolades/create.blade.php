@extends('layouts.admin')

@section('title', 'Add Teacher Accolade')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .form-container {
        background-color: #ffffff;
        padding: 35px;
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .form-container h2 {
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 25px;
    }

    .form-label i {
        color: #007bff;
        margin-right: 8px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .alert-danger ul {
        margin-bottom: 0;
    }
</style>
@endsection

@section('content')
<div class="container mt-5">
    <div class="form-container mx-auto col-lg-8">
        <h2><i class="fas fa-award me-2"></i>Add Teacher Accolade</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <strong><i class="fas fa-exclamation-circle me-2"></i> Please fix the following errors:</strong>
                <ul class="mt-2 mb-0">
                    @foreach($errors->all() as $error)
                        <li><i class="fas fa-times-circle text-danger me-1"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.teachers_accolades.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="teacher_name" class="form-label"><i class="fas fa-user"></i> Teacher Name</label>
                <input type="text" name="teacher_name" id="teacher_name" class="form-control" placeholder="e.g. John Doe" required>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label"><i class="fas fa-trophy"></i> Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="e.g. Best Educator Award" required>
            </div>

            <div class="mb-3">
                <label for="year" class="form-label"><i class="fas fa-calendar-alt"></i> Year</label>
                <input type="text" name="year" id="year" class="form-control" placeholder="e.g. 2024" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label"><i class="fas fa-align-left"></i> Description</label>
                <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter a short description of the accolade..."></textarea>
            </div>

            <div class="mb-4">
                <label for="image" class="form-label"><i class="fas fa-image"></i> Upload Image</label>
                <input type="file" name="image" id="image" class="form-control">
                <div class="form-text">Optional: Upload a relevant image (JPG, PNG).</div>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-plus-circle me-1"></i> Add Accolade
            </button>
        </form>
    </div>
</div>
@endsection
