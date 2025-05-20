@extends('layouts.admin')

@section('title', 'Edit Co-Curricular Program')
@section('breadcrumb-title', 'Activities')
@section('breadcrumb-link', route('admin.activities'))

@section('styles')
    <!-- Bootstrap Icons CDN (optional if not already included) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4 text-primary"><i class="bi bi-pencil-square me-2"></i>Edit Co-Curricular Program</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Program Edit Form -->
    <form action="{{ route('admin.co_curricular_programs.update', $program) }}" method="POST" enctype="multipart/form-data" class="shadow p-4 rounded bg-light">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label"><i class="bi bi-award me-1"></i>Program Name</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-pencil"></i></span>
                <input type="text" name="name" class="form-control" value="{{ old('name', $program->name) }}" required>
            </div>
            @error('name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category" class="form-label"><i class="bi bi-tags me-1"></i>Category</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-list-ul"></i></span>
                <select name="category" class="form-select" required>
                    @foreach(['Arts', 'Dance', 'Drama', 'Music', 'Sports'] as $category)
                        <option value="{{ $category }}" {{ $program->category == $category ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
            </div>
            @error('category')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label"><i class="bi bi-card-text me-1"></i>Description</label>
            <textarea name="description" class="form-control" rows="4" required>{{ old('description', $program->description) }}</textarea>
            @error('description')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label"><i class="bi bi-image me-1"></i>Program Image</label>
            <input type="file" name="image" class="form-control" onchange="previewImage(event)">
            <small class="text-muted">Leave blank if you don't want to change the image.</small>

            <div class="mt-3">
                <img 
                    src="{{ $program->image_url ?? '' }}" 
                    id="image-preview" 
                    class="img-thumbnail" 
                    style="max-width: 200px; {{ $program->image_url ? 'display: block;' : 'display: none;' }}"
                >
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            <i class="bi bi-arrow-repeat me-1"></i>Update Program
        </button>
    </form>
</div>

<!-- Image Preview Script -->
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function() {
            const preview = document.getElementById('image-preview');
            preview.src = reader.result;
            preview.style.display = 'block';
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
