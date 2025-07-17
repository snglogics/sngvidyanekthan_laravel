@extends('layouts.admin')

@section('title', 'Manage Gallery')
@section('breadcrumb-title', 'Activities')
@section('breadcrumb-link', route('admin.activities'))
@section('styles')
    <link href="{{ asset('frontend/css/uploadPrincipal.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="card p-4">
        <h2 class="text-center mb-4 fw-bold text-primary" data-aos="zoom-in">Manage Events</h2>

        @if (session('success'))
            <div class="alert alert-success text-center" data-aos="fade-down">
                <p class="mb-0">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Add Images Section -->
        <div class="mb-4" data-aos="fade-up">

            <form id="uploadForm" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label fw-bold">Common Header</label>
                    <input type="text" name="common_header" class="form-control" placeholder="Enter Common Header"
                        required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Event Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Optional"></textarea>
                </div>
                <div id="imageInputs" class="d-flex flex-column gap-3"></div>
                <button type="button" class="btn btn-success  mt-3" id="addImageBtn">Add Image</button>


                <button type="submit" class="btn btn-primary mt-3" id="uploadButton">
                    <span class="spinner-border spinner-border-sm d-none me-2" role="status" aria-hidden="true"
                        id="uploadSpinner"></span>
                    <span id="uploadText">Upload All Images</span>
                </button>
            </form>
        </div>

        <!-- Gallery Display (same as previous version) -->
        <div class="gallery-display" data-aos="fade-up" data-aos-delay="100">
            @foreach ($galleryImages as $commonHeader => $images)
                <div class="mb-4 border rounded shadow-sm p-3 bg-light">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="fw-bold text-primary mb-0">
                                <i class="fas fa-folder-open me-2"></i>{{ $commonHeader }}
                            </h4>

                            <form action="{{ route('event.deleteByHeader') }}" method="POST"
                                onsubmit="return confirm('Delete all images under {{ $commonHeader }}?');">
                                @csrf
                                <input type="hidden" name="common_header" value="{{ $commonHeader }}">
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i> Delete Group
                                </button>
                            </form>
                        </div>

                        @if (optional($images->first())->description)
                            <p class="text-muted mt-1 ms-1">{{ $images->first()->description }}</p>
                        @endif
                    </div>

                    <div class="row g-4">
                        @foreach ($images as $image)
                            <div class="col-md-4 col-sm-6" data-aos="fade-up">
                                <div class="card h-100 shadow-sm border-0">
                                    <img src="{{ $image->image_url }}" alt="Gallery Image" class="card-img-top rounded-top"
                                        style="height: 200px; object-fit: cover;">
                                    <div class="card-body text-center">
                                        <h5 class="fw-bold">{{ $image->header }}</h5>
                                        <div class="d-flex justify-content-center gap-2 mt-2">

                                            <form action="{{ route('event.delete', $image->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this image?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const imageInputs = document.getElementById('imageInputs');
        const addImageBtn = document.getElementById('addImageBtn');

        addImageBtn.addEventListener('click', () => {
            const inputGroup = document.createElement('div');
            inputGroup.classList.add('d-flex', 'gap-2', 'align-items-center');

            inputGroup.innerHTML = `
            <input type="text" name="headers[]" placeholder="Enter Header" class="form-control" required>
            <input type="file" name="images[]" accept="image/*" class="form-control" required>
            <button type="button" class="btn btn-danger remove-btn">Remove</button>
        `;

            imageInputs.appendChild(inputGroup);

            inputGroup.querySelector('.remove-btn').addEventListener('click', () => {
                inputGroup.remove();
            });
        });

        document.getElementById('uploadForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            const uploadButton = document.getElementById('uploadButton');
            const uploadSpinner = document.getElementById('uploadSpinner');
            const uploadText = document.getElementById('uploadText');

            uploadSpinner.classList.remove('d-none');
            uploadText.textContent = 'Uploading...';
            uploadButton.disabled = true;

            try {
                const response = await fetch("{{ route('event.upload') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: formData
                });

                const result = await response.json();

                uploadSpinner.classList.add('d-none');
                uploadText.textContent = 'Upload All Images';
                uploadButton.disabled = false;

                if (result.success) {
                    toastr.success(result.message, 'Success');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    toastr.error(result.message || 'Upload failed.', 'Error');
                }
            } catch (error) {
                console.error('Upload Error:', error);
                toastr.error('Something went wrong.', 'Error');
                uploadSpinner.classList.add('d-none');
                uploadText.textContent = 'Upload All Images';
                uploadButton.disabled = false;
            }
        });
    </script>
@endsection
