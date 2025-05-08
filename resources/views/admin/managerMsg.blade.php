@extends('layouts.admin')

@section('title', 'Upload Image')

@section('styles')
<link href="{{ asset('frontend/css/uploadPrincipal.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="card p-4">
    <h2 class="text-center mb-4 fw-bold text-primary" data-aos="zoom-in">Upload Manager's Message</h2>

    @if(session('success'))
    @php
        $success = session('success');
    @endphp

    <div class="alert alert-success text-center" data-aos="fade-down">
        @if(is_array($success))
            <h4 class="mb-3">{{ $success['imageName'] ?? '' }}</h4>
            <p class="mt-3">{{ $success['description'] ?? '' }}</p>
        @else
            <p class="mt-3">{{ $success }}</p>
        @endif
    </div>
@endif

    @if($existingMsg)
        <div class="mb-5 p-4 border rounded shadow-sm bg-light" data-aos="fade-right">
            <h4 class="text-primary text-center mb-3">Current Manager's Message</h4>
            <div class="text-center mb-3">
                <img src="{{ $existingMsg->image_url }}" alt="Manager Photo" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
            </div>
            <h5 class="text-center fw-bold">{{ $existingMsg->image_name }}</h5>
            <p class="text-center fst-italic text-muted">{{ $existingMsg->image_header }}</p>
            <p class="text-center">{{ $existingMsg->description }}</p>
        </div>
    @endif

    <form action="{{ route('admin.manager.upload') }}" method="POST" enctype="multipart/form-data" data-aos="fade-up" data-aos-delay="200">
        @csrf

        <div class="text-center mb-3">
            <label for="image" class="cursor-pointer">
                <img id="uploadLogo"
                     src="{{ session('success') ? session('success')['imageUrl'] : 'https://cdn-icons-png.flaticon.com/512/847/847969.png' }}"
                     alt="Logo"
                     class="logo"
                     style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%; border: 2px dashed #ccc;" />
            </label>
            <input type="file" id="image" name="image" accept="image/*" class="d-none" required>
            @error('image')
                <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="imageName" class="form-label">Manager Name</label>
            <input type="text" class="form-control" id="imageName" name="imageName" placeholder="Enter Manager name" required value="{{ old('imageName') }}">
            @error('imageName')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="imageHeader" class="form-label">Message Title</label>
            <input type="text" class="form-control" id="imageHeader" name="imageHeader" placeholder="Message Title" value="{{ old('imageHeader') }}">
            @error('imageHeader')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Enter description" value="{{ old('description') }}">
            @error('description')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2" id="submitBtn">
            {{ $existingMsg ? 'Update Now' : 'Upload Now' }}
        </button>
    </form>
</div>
@endsection

@section('scripts')
<script src="{{ asset('frontend/js/uploadPrincipal.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    // Preview image when selected
    document.getElementById('image').addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            const logo = document.getElementById('uploadLogo');
            logo.src = URL.createObjectURL(file);
        }
    });

    // Button loader and label update
    const form = document.querySelector('form');
    const submitButton = document.getElementById('submitBtn');
    const isUpdate = @json(isset($existingMsg) && $existingMsg);

    form.addEventListener('submit', function () {
        submitButton.disabled = true;
        submitButton.innerHTML = `
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ${isUpdate ? 'Updating...' : 'Uploading...'}
        `;
    });

    // Toastr messages
    @if (session('success'))
        toastr.success("{{ session('success')['message'] ?? 'Image uploaded successfully!' }}", 'Success');
    @elseif (session('error'))
        toastr.error("{{ session('error') }}", 'Error');
    @endif
</script>
@endsection
