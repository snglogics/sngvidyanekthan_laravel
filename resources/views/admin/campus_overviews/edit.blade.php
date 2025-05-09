@extends('layouts.admin')

@section('title', 'Edit Campus Overview')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Edit Campus Overview</h2>
    <form action="{{ route('admin.campus-overviews.update', $campusOverview->id) }}" method="POST" enctype="multipart/form-data" id="overviewForm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Main Heading</label>
            <input type="text" name="main_heading" class="form-control" value="{{ $campusOverview->main_heading }}" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4" required>{{ $campusOverview->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Existing Photos</label>
            <div class="row">
                @foreach($campusOverview->photos as $index => $photo)
                    @php
                        $photoUrl = is_array($photo) ? $photo['url'] : $photo;
                        $photoTitle = is_array($photo) ? ($photo['title'] ?? '') : '';
                    @endphp
                    <div class="col-md-3 mb-3" style="position: relative;">
                        <img src="{{ $photoUrl }}" alt="Campus Photo" style="width: 100%; height: 150px; object-fit: cover; cursor: pointer;" onclick="openPhotoUpdateModal('{{ $photoUrl }}', {{ $index }})">
                        
                        <input type="text" name="photo_titles[]" value="{{ $photoTitle }}" class="form-control mt-2" placeholder="Enter Photo Title">
                        <input type="hidden" name="existing_photos[]" value="{{ $photoUrl }}">

                        <form action="{{ route('admin.campus-overviews.delete-photo', ['campusOverview' => $campusOverview->id, 'photoIndex' => $index]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm mt-2" onclick="return confirm('Are you sure you want to delete this photo?')">Delete</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-3">
            <label>New Photos</label>
            <input type="file" name="photos[]" multiple class="form-control">
            <small class="text-muted">Leave this empty if you do not want to add new photos.</small>
        </div>

        <button type="submit" class="btn btn-primary" id="submitBtn">Update Overview</button>
    </form>
</div>

<!-- Update Photo Modal -->
<div class="modal fade" id="photoUpdateModal" tabindex="-1" aria-labelledby="photoUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" enctype="multipart/form-data" id="updatePhotoForm">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="photoUpdateModalLabel">Update Photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="file" name="new_photo" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Photo</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        console.log("DOM fully loaded and parsed");

        const overviewForm = document.getElementById('overviewForm');
        const updatePhotoForm = document.getElementById('updatePhotoForm');
        const submitBtn = document.getElementById('submitBtn');

        // Check if the form elements are correctly selected
        if (!overviewForm || !updatePhotoForm || !submitBtn) {
            console.error("Form elements not found");
            return;
        }

        // Main form submit handling
        overviewForm.addEventListener('submit', function(e) {
            console.log("Main form submitted");
          
            // Disable the button and show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...
            `;

            // Submit the form manually
            this.submit();
        });

        // Photo update form handling
        updatePhotoForm.addEventListener('submit', function(e) {
            console.log("Photo form submitted");
        });
    });

    function openPhotoUpdateModal(photoUrl, index) {
        console.log("Opening modal for photo index:", index);
        const updateForm = document.getElementById('updatePhotoForm');
        updateForm.action = `/admin/campus-overviews/{{ $campusOverview->id }}/photos/${index}/update`;
        const modal = new bootstrap.Modal(document.getElementById('photoUpdateModal'));
        modal.show();
    }
</script>
@endsection

