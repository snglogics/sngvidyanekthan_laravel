@extends('layouts.admin')

@section('title', 'Edit Field Trip')
@section('breadcrumb-title', 'Student Life')
@section('breadcrumb-link', route('admin.studentlife'))

@section('styles')
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@section('content')
<div class="container py-4">
    <div class="card shadow-sm p-4 border-0">
        <h2 class="text-center mb-4 text-primary"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Field Trip</h2>

        <form action="{{ route('admin.field_trips.update', $trip->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label"><i class="fa-solid fa-heading me-2 text-primary"></i>Trip Title</label>
                <input type="text" name="title" class="form-control" value="{{ $trip->title }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label"><i class="fa-solid fa-map-location-dot me-2 text-success"></i>Location</label>
                <input type="text" name="location" class="form-control" value="{{ $trip->location }}" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fa-solid fa-calendar-day me-2 text-info"></i>Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="{{ $trip->start_date }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fa-solid fa-calendar-check me-2 text-info"></i>End Date</label>
                    <input type="date" name="end_date" class="form-control" value="{{ $trip->end_date }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label"><i class="fa-solid fa-user-tie me-2 text-secondary"></i>Contact Person</label>
                <input type="text" name="contact_person" class="form-control" value="{{ $trip->contact_person }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label"><i class="fa-solid fa-phone me-2 text-secondary"></i>Contact Number</label>
                <input type="text" name="contact_number" class="form-control" value="{{ $trip->contact_number }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label"><i class="fa-solid fa-align-left me-2 text-warning"></i>Description</label>
                <textarea name="description" class="form-control" rows="4" required>{{ $trip->description }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label"><i class="fa-solid fa-image me-2 text-danger"></i>Trip Image</label>
                <input type="file" name="image" class="form-control" onchange="previewImage(event)">
                
                @if($trip->image_url)
                    <img src="{{ $trip->image_url }}" id="image-preview" class="mt-3 img-thumbnail" style="max-width: 200px;">
                @else
                    <img id="image-preview" class="mt-3 img-thumbnail" style="max-width: 200px; display: none;">
                @endif
                <small class="text-muted">Leave blank if you don't want to change the image.</small>
            </div>

            <button type="submit" class="btn btn-success w-100">
                <i class="fa-solid fa-floppy-disk me-1"></i> Update Field Trip
            </button>
        </form>
    </div>
</div>

<!-- Image Preview Script -->
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = function () {
            const preview = document.getElementById('image-preview');
            preview.src = reader.result;
            preview.style.display = 'block';
        };
        if (file) reader.readAsDataURL(file);
    }
</script>
@endsection
