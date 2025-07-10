@extends('layouts.admin')

@section('title', 'Upload Video')
@section('breadcrumb-title', 'Gallery')
@section('breadcrumb-link', route('admin.galleries'))

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
            <h2 class="text-primary mb-0"><i class="fas fa-upload me-2"></i>Upload New Video</h2>
            <a href="{{ route('admin.videos.index') }}" class="btn btn-outline-primary btn-sm shadow-sm">
                <i class="fas fa-video me-1"></i> View All Videos
            </a>
        </div>

        <div class="card shadow-lg border-0">
            <div class="card-body">
                <form id="uploadForm" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold"><i class="fas fa-heading me-1 text-secondary"></i>Title</label>
                        <input type="text" name="title" class="form-control shadow-sm" placeholder="Enter video title"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold"><i class="fas fa-file-video me-1 text-secondary"></i>Video
                            File</label>
                        <input type="file" name="video" class="form-control shadow-sm" accept="video/*" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold"><i class="fas fa-list-alt me-1 text-secondary"></i>Type</label>
                        <select name="type" class="form-select shadow-sm" required>
                            <option value="album">🎞️ Video Album</option>
                            <option value="virtual">🌐 360° Virtual Tour</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 shadow-sm" id="submitBtn">
                        <i class="fas fa-cloud-upload-alt me-2"></i>Upload Video
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        const form = document.getElementById('uploadForm');
        const submitBtn = document.getElementById('submitBtn');

        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            submitBtn.disabled = true;
            submitBtn.innerHTML = `
            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Uploading...
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

                if (response.ok) {
                    const data = await response.json();
                    if (data.success) {
                        toastr.success(data.message || "Uploaded successfully", "Success");
                        form.reset();
                    } else {
                        toastr.error(data.message || "Upload failed", "Error");
                    }
                } else if (response.status === 422) {
                    const data = await response.json();
                    const errors = data.errors;
                    for (let field in errors) {
                        errors[field].forEach(msg => toastr.error(msg, "Validation Error"));
                    }
                } else {
                    const text = await response.text();
                    console.error("Unexpected response:", text);
                    toastr.error("An unexpected error occurred.", "Upload Error");
                }
            } catch (error) {
                toastr.error(error.message || "An unexpected error occurred.", "Upload Error");
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = `<i class="fas fa-cloud-upload-alt me-2"></i>Upload Video`;
            }
        });
    </script>
@endsection
