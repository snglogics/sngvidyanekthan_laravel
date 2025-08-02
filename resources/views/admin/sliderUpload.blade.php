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
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
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

        .form-control:focus,
        textarea:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, .25);
        }
    </style>
@endsection

@section('content')
    <div class="card p-4 upload-card bg-white">
        <h2 class="text-center mb-4 fw-bold text-primary" data-aos="zoom-in">
            <i class="bi bi-images me-2"></i> Manage Sliders
        </h2>

        {{-- ✅ Show success message --}}
        @if (session('success'))
            <div class="alert alert-success text-center" data-aos="fade-down">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive" data-aos="fade-up" data-aos-delay="200">
            <table
                class="table table-hover table-striped table-bordered text-center align-middle rounded overflow-hidden shadow-sm">
                <thead class="bg-primary text-white">
                    <tr class="fw-semibold">
                        <th scope="col"><i class="bi bi-card-image me-1"></i> Image</th>
                        <th scope="col"><i class="bi bi-type me-1"></i> Heading</th>
                        <th scope="col"><i class="bi bi-card-text me-1"></i> Description</th>
                        <th scope="col"><i class="bi bi-gear-fill me-1"></i> Action</th>
                    </tr>
                </thead>
                <tbody>
    @foreach ($sliders as $slider)
        <tr data-id="{{ $slider->id }}">
            <td>
                <label class="d-inline-block">
                    <img id="preview_{{ $slider->id }}"
                        src="{{ $slider->image ?? 'https://cdn-icons-png.flaticon.com/512/847/847969.png' }}"
                        alt="Slider Image" class="preview-image" />
                </label>
                <input type="file" class="d-none file-upload" data-id="{{ $slider->id }}" accept="image/*">
            </td>
            <td>
                <input type="text" class="form-control heading-input"
                    placeholder="Enter heading" value="{{ $slider->heading }}">
            </td>
            <td>
                <textarea class="form-control description-input"
                    placeholder="Enter description" rows="3">{{ $slider->description }}</textarea>
            </td>
            <td class="d-flex flex-column gap-2">
    <button type="button" class="btn btn-success upload-btn w-100"
        data-id="{{ $slider->id }}">
        <i class="bi bi-cloud-upload me-1"></i> Upload
    </button>
    <button type="button" class="btn btn-danger delete-btn w-100"
        data-id="{{ $slider->id }}">
        <i class="bi bi-trash me-1"></i> Delete
    </button>
</td>
        </tr>
    @endforeach

    {{-- Empty row for new slider --}}
    <tr data-id="">
        <td>
            <label class="d-inline-block">
                <img id="preview_new"
                    src="https://cdn-icons-png.flaticon.com/512/847/847969.png"
                    alt="New Slider" class="preview-image" />
            </label>
            <input type="file" class="d-none file-upload" data-id="new" accept="image/*">
        </td>
        <td><input type="text" class="form-control heading-input" placeholder="Enter heading"></td>
        <td><textarea class="form-control description-input" placeholder="Enter description" rows="3"></textarea></td>
        <td>
            <button type="button" class="btn btn-success upload-btn w-100" data-id="new">
                <i class="bi bi-cloud-upload me-1"></i> Upload
            </button>
        </td>
    </tr>
</tbody>

            </table>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('.preview-image').forEach((img, i) => {
        img.addEventListener('click', () => {
            const input = img.closest('td').querySelector('.file-upload');
            input.click();
        });
    });

    document.querySelectorAll('.file-upload').forEach(input => {
        input.addEventListener('change', function () {
            const [file] = this.files;
            if (file) {
                const previewId = this.dataset.id === 'new' ? 'preview_new' : `preview_${this.dataset.id}`;
                document.getElementById(previewId).src = URL.createObjectURL(file);
            }
        });
    });

    document.querySelectorAll('.upload-btn').forEach(button => {
        button.addEventListener('click', async function () {
            const id = this.dataset.id;
            const row = this.closest('tr');
            const fileInput = row.querySelector('.file-upload');
            const heading = row.querySelector('.heading-input').value;
            const description = row.querySelector('.description-input').value;

            const formData = new FormData();
            if (fileInput.files.length > 0) {
                formData.append('image', fileInput.files[0]);
            }
            formData.append('heading', heading);
            formData.append('description', description);

            if (id && id !== 'new') {
                formData.append('slider_id', id);
            }

            const buttonOriginalHTML = this.innerHTML;
            this.disabled = true;
            this.innerHTML = `<span class="spinner-border spinner-border-sm"></span> Uploading`;

            try {
                const response = await fetch("{{ route('slider.upload') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const result = await response.json();

                if (result.success) {
                    toastr.success(result.message, 'Success');
                    setTimeout(() => location.reload(), 800);
                } else {
                    toastr.error(result.message || 'Upload failed.', 'Error');
                }
            } catch (error) {
                toastr.error('Something went wrong.', 'Error');
                console.error(error);
            }

            this.disabled = false;
            this.innerHTML = buttonOriginalHTML;
        });
    });
</script>
<script>
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', async function () {
            const id = this.dataset.id;

            if (!confirm("Are you sure you want to delete this slider?")) return;

            try {
                const response = await fetch("{{ route('slider.delete') }}", {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id })
                });

                const result = await response.json();

                if (result.success) {
                    toastr.success(result.message, 'Deleted');
                    setTimeout(() => location.reload(), 800);
                } else {
                    toastr.error(result.message || 'Failed to delete.', 'Error');
                }
            } catch (error) {
                toastr.error('Delete failed.', 'Error');
                console.error(error);
            }
        });
    });
</script>

@endsection

