@extends('layouts.admin')

@section('title', 'Edit Co-Curricular Program')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4 text-primary">Edit Co-Curricular Program</h2>

    <!-- Program Edit Form -->
    <form action="{{ route('admin.co_curricular_programs.update', $program) }}" method="POST" enctype="multipart/form-data">

    @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Program Name</label>
            <input type="text" name="name" class="form-control" value="{{ $program->name }}" required>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select name="category" class="form-select" required>
                <option value="Arts" {{ $program->category == 'Arts' ? 'selected' : '' }}>Arts</option>
                <option value="Dance" {{ $program->category == 'Dance' ? 'selected' : '' }}>Dance</option>
                <option value="Drama" {{ $program->category == 'Drama' ? 'selected' : '' }}>Drama</option>
                <option value="Music" {{ $program->category == 'Music' ? 'selected' : '' }}>Music</option>
                <option value="Sports" {{ $program->category == 'Sports' ? 'selected' : '' }}>Sports</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" required>{{ $program->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Program Image</label>
            <input type="file" name="image" class="form-control" onchange="previewImage(event)">
            
            <!-- Show Current Image -->
            @if($program->image_url)
                <img src="{{ $program->image_url }}" class="mt-3" style="max-width: 200px; display: block;" id="image-preview">
            @else
                <img id="image-preview" class="mt-3" style="max-width: 200px; display: none;">
            @endif

            <small class="text-muted">Leave blank if you don't want to change the image.</small>
        </div>

        <button type="submit" class="btn btn-primary w-100">Update Program</button>
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
