@extends('layouts.admin')

@section('title', 'Upload Sliders')
@section('breadcrumb-title', 'Home')
@section('breadcrumb-link', route('admin.home'))

@section('styles')
<link href="{{ asset('frontend/css/uploadPrincipal.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
    .upload-card {
        border-radius: 15px;
        box-shadow: 0 0 15px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .preview-image {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px dashed #ccc;
        transition: 0.3s;
    }
    .preview-image:hover {
        border-color: #0d6efd;
        transform: scale(1.05);
        cursor: pointer;
    }
    .upload-btn {
        transition: all 0.3s ease-in-out;
    }
    .upload-btn:disabled {
        opacity: 0.7;
    }
    .form-control:focus, textarea:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13,110,253,.25);
    }
</style>
@endsection

@section('content')
<div class="card p-4 upload-card bg-white">
    <h2 class="text-center mb-4 fw-bold text-primary" data-aos="zoom-in">
        <i class="bi bi-images me-2"></i> Manage Sliders
    </h2>

    {{-- ✅ Show success message --}}
    @if(session('success'))
        <div class="alert alert-success text-center" data-aos="fade-down">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive" data-aos="fade-up" data-aos-delay="200">
        <table class="table table-hover table-striped table-bordered text-center align-middle rounded overflow-hidden shadow-sm">
            <thead class="bg-primary text-white">
                <tr class="fw-semibold">
                    <th scope="col"><i class="bi bi-card-image me-1"></i> Image</th>
                    <th scope="col"><i class="bi bi-type me-1"></i> Heading</th>
                    <th scope="col"><i class="bi bi-card-text me-1"></i> Description</th>
                    <th scope="col"><i class="bi bi-gear-fill me-1"></i> Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach (['slider1', 'slider2', 'slider3'] as $slider)
                <tr>
                    <td>
                        <label for="{{ $slider }}" class="d-inline-block">
                            <img id="preview_{{ $slider }}"
                                src="{{ $images[$slider] ?? 'https://cdn-icons-png.flaticon.com/512/847/847969.png' }}"
                                alt="{{ $slider }}"
                                class="preview-image" />
                        </label>
                        <input type="file" id="{{ $slider }}" name="{{ $slider }}" class="d-none file-upload" data-slider="{{ $slider }}" accept="image/*">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="{{ $slider }}_heading"
                            placeholder="Enter heading"
                            value="{{ $images[$slider . '_heading'] ?? '' }}">
                    </td>
                    <td>
                        <textarea class="form-control" id="{{ $slider }}_description"
                            placeholder="Enter description"
                            rows="3">{{ $images[$slider . '_description'] ?? '' }}</textarea>
                    </td>
                    <td>
                        <button type="button" class="btn btn-success upload-btn w-100" data-slider="{{ $slider }}">
                            <i class="bi bi-cloud-upload me-1"></i> Upload
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    document.querySelectorAll('.file-upload').forEach(input => {
        input.addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                const preview = document.getElementById(`preview_${event.target.dataset.slider}`);
                preview.src = URL.createObjectURL(file);
            }
        });
    });

    document.querySelectorAll('.upload-btn').forEach(button => {
        button.addEventListener('click', async function () {
            const slider = button.dataset.slider;
            const fileInput = document.getElementById(slider);

            if (!fileInput.files.length) {
                toastr.warning('Please select an image first.', 'Notice');
                return;
            }

            const formData = new FormData();
            formData.append('image', fileInput.files[0]);
            formData.append('slider', slider);

            const headingInput = document.getElementById(`${slider}_heading`);
            const descriptionInput = document.getElementById(`${slider}_description`);
            formData.append('heading', headingInput.value || '');
            formData.append('description', descriptionInput.value || '');

            button.disabled = true;
            button.innerHTML = `<span class="spinner-border spinner-border-sm"></span> Uploading`;

            try {
                const response = await fetch("{{ route('slider.upload') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: formData
                });

                const contentType = response.headers.get("content-type");

                if (contentType && contentType.includes("application/json")) {
                    const result = await response.json();

                    if (result.success) {
                        toastr.success(result.message, 'Success');
                    } else {
                        toastr.error(result.message || 'Upload failed.', 'Error');
                    }
                } else {
                    const errorText = await response.text();
                    console.error('Non-JSON response:', errorText);
                    toastr.error('Unexpected error. Check console.', 'Error');
                }
            } catch (error) {
                console.error('Upload Error:', error);
                toastr.error('Something went wrong during upload.', 'Error');
            }

            button.disabled = false;
            button.innerHTML = `<i class="bi bi-cloud-upload me-1"></i> Upload`;
        });
    });
</script>
@endsection
