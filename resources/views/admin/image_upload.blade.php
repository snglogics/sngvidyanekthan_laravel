@extends('layouts.admin')

@section('title', 'Upload Principal Message')

@section('styles')
<link href="{{ asset('frontend/css/uploadPrincipal.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container py-5">
    <div class="card p-4">

        {{-- Page Header --}}
        <h2 class="text-center mb-4 fw-bold text-primary" data-aos="zoom-in">
            {{ session('success') ? 'Update Principal Message' : 'Upload Principal Message' }}
        </h2>

        {{-- Show success message --}}
        @if(session('success'))
            <div class="alert alert-success text-center" data-aos="fade-down">
                <h4 class="mb-3">{{ session('success')['imageName'] }}</h4>
                <img src="{{ session('success')['imageUrl'] }}" alt="Uploaded Image" style="width: 150px; height: 150px; object-fit: cover; border-radius: 10px; margin-bottom: 15px;">
                <p>{{ session('success')['description'] }}</p>
            </div>
        @endif

        {{-- Upload Form --}}
        <form id="uploadForm" action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data" data-aos="fade-up" data-aos-delay="200">
            @csrf

            {{-- Upload by clicking image --}}
            <div class="text-center mb-3">
                <label for="image" class="cursor-pointer" id="imageLabel">
                    <img id="uploadLogo" 
                         src="{{ session('success') ? session('success')['imageUrl'] : asset('images/placeholder.png') }}" 
                         alt="Logo" 
                         class="logo" 
                         style="width: 150px; height: 150px; object-fit: cover; border-radius: 10px; border: 2px dashed #ccc;" />
                </label>
                <input type="file" id="image" name="image" accept="image/*" class="d-none" required>
                @error('image')
                    <div class="text-danger small mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="imageName" class="form-label">Principal Name</label>
                <input type="text" class="form-control" id="imageName" name="imageName" placeholder="Enter principal name" required value="{{ old('imageName') }}">
                @error('imageName')
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

            <div class="mb-3">
                <label for="imageHeader" class="form-label">Message Header</label>
                <input type="text" class="form-control" id="imageHeader" name="imageHeader" placeholder="Enter image header" value="{{ old('imageHeader') }}">
                @error('imageHeader')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            {{-- Submit Button --}}
            <button type="submit" id="uploadButton" class="btn btn-primary w-100 py-2">
                {{ session('success') ? 'Update Now' : 'Upload Now' }}
            </button>
        </form>

    </div>
</div>
@endsection

@section('scripts')
<script>
    // ✅ Image Preview without Changing Button Label
    document.getElementById('image').addEventListener('change', function(event) {
        const [file] = event.target.files;
        const logo = document.getElementById('uploadLogo');
        
        if (file) {
            logo.src = URL.createObjectURL(file);
        }
    });

    // ✅ Change Button Label on Form Submit
    const form = document.getElementById('uploadForm');
    const submitButton = document.getElementById('uploadButton');

    form.addEventListener('submit', function() {
        // Change button label only on form submit
        submitButton.disabled = true;
        submitButton.innerHTML = `
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...
        `;
    });

    // ✅ Show Toastr message after reload based on session
    @if (session('success'))
        toastr.success("{{ session('success')['message'] ?? 'Image uploaded successfully!' }}", 'Success');
    @elseif (session('error'))
        toastr.error("{{ session('error') }}", 'Error');
    @endif
</script>
@endsection
