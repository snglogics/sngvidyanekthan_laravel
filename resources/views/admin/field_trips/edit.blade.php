@extends('layouts.admin')

@section('title', 'Edit Field Trip')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4 text-primary">Edit Field Trip</h2>

    <form action="{{ route('admin.field_trips.update', $trip->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Trip Title</label>
            <input type="text" name="title" class="form-control" value="{{ $trip->title }}" required>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" class="form-control" value="{{ $trip->location }}" required>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" class="form-control" value="{{ $trip->start_date }}" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" name="end_date" class="form-control" value="{{ $trip->end_date }}" required>
        </div>

        <div class="mb-3">
            <label for="contact_person" class="form-label">Contact Person</label>
            <input type="text" name="contact_person" class="form-control" value="{{ $trip->contact_person }}" required>
        </div>

        <div class="mb-3">
            <label for="contact_number" class="form-label">Contact Number</label>
            <input type="text" name="contact_number" class="form-control" value="{{ $trip->contact_number }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" required>{{ $trip->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Trip Image</label>
            <input type="file" name="image" class="form-control" onchange="previewImage(event)">
            
            <!-- Show Current Image -->
            @if($trip->image_url)
                <img src="{{ $trip->image_url }}" class="mt-3" style="max-width: 200px; display: block;" id="image-preview">
            @else
                <img id="image-preview" class="mt-3" style="max-width: 200px; display: none;">
            @endif

            <small class="text-muted">Leave blank if you don't want to change the image.</small>
        </div>

        <button type="submit" class="btn btn-primary w-100">Update Field Trip</button>
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
