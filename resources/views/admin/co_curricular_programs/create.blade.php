@extends('layouts.admin')

@section('title', 'Add Co-Curricular Program')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4 text-primary">Add Co-Curricular Program</h2>

    <!-- Program Create Form -->
    <form action="{{ route('admin.co_curricular_programs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Program Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select name="category" class="form-select" required>
                <option value="Arts">Arts</option>
                <option value="Dance">Dance</option>
                <option value="Drama">Drama</option>
                <option value="Music">Music</option>
                <option value="Sports">Sports</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Program Image</label>
            <input type="file" name="image" class="form-control" onchange="previewImage(event)">
            <img id="image-preview" class="mt-3" style="max-width: 200px; display: none;">
        </div>

        <button type="submit" class="btn btn-primary w-100">Add Program</button>
    </form>

    <hr class="my-5">

    <!-- Existing Programs List -->
    <h2 class="text-center mb-4 text-primary">Existing Programs</h2>

    <div class="row">
        @foreach($programs as $program)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-lg rounded-4 border-0">
                @if($program->image_url)
                    <img src="{{ $program->image_url }}" class="card-img-top rounded-top-4" alt="{{ $program->name }}" style="height: 200px; object-fit: cover;">
                @else
                    <div class="card-img-top rounded-top-4 bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                        No Image
                    </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title text-primary">{{ $program->name }}</h5>
                    <p class="card-subtitle mb-2 text-muted">{{ $program->category }}</p>
                    <p class="card-text">{{ Str::limit($program->description, 100) }}</p>

                    <!-- Edit Button -->
                    <a href="{{ route('admin.co_curricular_programs.edit', $program->id) }}" class="btn btn-warning btn-sm mb-2 w-100">
                        <i class="fas fa-edit"></i> Edit
                    </a>

                    <!-- Delete Button -->
                    <form action="{{ route('admin.co_curricular_programs.destroy', $program->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this program?')" class="w-100">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm w-100">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
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
            preview.style.display = 'block';
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
