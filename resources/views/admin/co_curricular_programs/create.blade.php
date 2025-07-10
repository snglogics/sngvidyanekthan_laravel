@extends('layouts.admin')

@section('title', 'Add Co-Curricular Program')
@section('breadcrumb-title', 'Activities')
@section('breadcrumb-link', route('admin.activities'))

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .hover-shadow:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
    </style>

@endsection

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">
                <i class="bi bi-plus-square-fill me-2"></i>Add Co-Curricular Program
            </h2>
        </div>

        <!-- Program Create Form -->
        <form id="program-upload-form" action="{{ route('admin.co_curricular_programs.store') }}" method="POST"
            enctype="multipart/form-data" class="bg-light p-4 rounded shadow-sm mb-5">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label fw-semibold"><i class="bi bi-bookmark-fill me-1"></i>Program
                    Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter program name" required>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label fw-semibold"><i class="bi bi-tags-fill me-1"></i>Category</label>
                <select name="category" class="form-select" required>
                    <option disabled selected>Select a category</option>
                    <option value="Arts">Arts</option>
                    <option value="Dance">Dance</option>
                    <option value="Drama">Drama</option>
                    <option value="Music">Music</option>
                    <option value="Sports">Sports</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label fw-semibold"><i
                        class="bi bi-pencil-square me-1"></i>Description</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Write a short description..." required></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label fw-semibold"><i class="bi bi-image-fill me-1"></i>Program
                    Image</label>
                <input type="file" name="image" class="form-control" onchange="previewImage(event)">
                <img id="image-preview" class="mt-3 rounded shadow-sm d-none" style="max-width: 200px;">
            </div>

            <button type="submit" id="submit-button" class="btn btn-success w-100 fw-semibold">
                <i class="bi bi-check-circle-fill me-1"></i>Add Program
            </button>
        </form>

        <!-- Divider -->
        <hr class="my-5">

        <!-- Existing Programs List -->
        <div class="text-center mb-4">
            <h2 class="fw-bold text-primary">
                <i class="bi bi-collection-fill me-2"></i>Existing Programs
            </h2>
        </div>

        <div class="row">
            @foreach ($programs as $program)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm rounded-4 border-0 h-100 hover-shadow">
                        @if ($program->image_url)
                            <img src="{{ $program->image_url }}" class="card-img-top rounded-top-4"
                                alt="{{ $program->name }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="card-img-top rounded-top-4 bg-secondary text-white d-flex align-items-center justify-content-center"
                                style="height: 200px;">
                                <i class="bi bi-image-alt fs-1"></i>
                                <p class="ms-2">No Image</p>
                            </div>
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-primary">{{ $program->name }}</h5>
                            <p class="card-subtitle mb-1 text-muted">{{ $program->category }}</p>
                            <p class="card-text flex-grow-1">{{ Str::limit($program->description, 100) }}</p>

                            <div class="d-flex gap-2 mt-3">
                                <a href="{{ route('admin.co_curricular_programs.edit', $program->id) }}"
                                    class="btn btn-outline-warning btn-sm w-50">
                                    <i class="bi bi-pencil-square me-1"></i>Edit
                                </a>
                                <form action="{{ route('admin.co_curricular_programs.destroy', $program->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this program?')"
                                    class="w-50">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm w-100">
                                        <i class="bi bi-trash-fill me-1"></i>Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Image Preview Script -->
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('image-preview');
                preview.src = reader.result;
                preview.classList.remove('d-none');
            };
            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
    <script>
        const form = document.getElementById('program-upload-form');
        const submitButton = document.getElementById('submit-button');

        form.addEventListener('submit', function() {
            submitButton.disabled = true;
            submitButton.innerHTML =
                '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Uploading...';
        });
    </script>

@endsection
