@extends('layouts.admin')

@section('title', 'Upload Video')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary mb-0">Upload Video</h2>
        <a href="{{ route('admin.videos.index') }}" class="btn btn-outline-primary btn-sm">
            <i class="fas fa-video"></i> View Videos
        </a>
    </div>

    <form id="uploadForm" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title:</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Video:</label>
            <input type="file" name="video" class="form-control" accept="video/*" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Type:</label>
            <select name="type" class="form-control" required>
                <option value="album">Video Album</option>
                <option value="virtual">360° Tour</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100" id="submitBtn">Upload</button>
    </form>
</div>
@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
const form = document.getElementById('uploadForm');
const submitBtn = document.getElementById('submitBtn');

form.addEventListener('submit', async function (e) {
    e.preventDefault();

    submitBtn.disabled = true;
    submitBtn.innerHTML = `
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Uploading...
    `;

    const formData = new FormData(form);

    try {
        const response = await fetch("{{ route('admin.videos.store') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: formData
        });

        if (response.status === 413) {
            throw new Error("The uploaded file is too large.");
        }

        const data = await response.json();

        if (data.success) {
            toastr.success(data.message || "Uploaded successfully", "Success");
            form.reset();
        } else {
            toastr.error(data.message || "Upload failed", "Error");
        }
    } catch (error) {
        toastr.error(error.message || "An unexpected error occurred.", "Upload Error");
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = 'Upload';
    }
});
</script>
@endsection
