@extends('layouts.admin')

@section('title', 'Upload Image')

@section('styles')

<link href="{{ asset('frontend/css/uploadPrincipal.css') }}" rel="stylesheet">
@endsection

@section('content')
    
           

                {{-- Card for Upload --}}
                <div class="card p-4">

                    {{-- Logo at the top --}}
                   

                    <h2 class="text-center mb-4 fw-bold text-primary" data-aos="zoom-in">Upload Principal Message</h2>

                    {{-- ✅ Show success message --}}
                    @if(session('success'))
                        <div class="alert alert-success text-center" data-aos="fade-down">
                            <h4 class="mb-3">{{ session('success')['imageName'] }}</h4>
                            <!-- <img src="{{ session('success')['imageUrl'] }}" alt="Uploaded Image"> -->
                            <p class="mt-3">{{ session('success')['description'] }}</p>
                        </div>
                    @endif

                    {{-- ✅ Upload Form --}}
                    <form action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data" data-aos="fade-up" data-aos-delay="200">
    @csrf

    {{-- ✅ Upload by clicking logo --}}
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
        <label for="imageName" class="form-label">Image Name</label>
        <input type="text" class="form-control" id="imageName" name="imageName" placeholder="Enter image name" required value="{{ old('imageName') }}">
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
        <label for="imageHeader" class="form-label">Image Header</label>
        <input type="text" class="form-control" id="imageHeader" name="imageHeader" placeholder="Enter image header" value="{{ old('imageHeader') }}">
        @error('imageHeader')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary w-100 py-2">Upload Now</button>
</form>


                </div>
           
       
@endsection

@section('scripts')
    <script src="{{ asset('frontend/js/uploadPrincipal.js') }}"></script>
    <script>
    document.getElementById('image').addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            const logo = document.getElementById('uploadLogo');
            logo.src = URL.createObjectURL(file);
        }
    });
</script>
<script>
    const form = document.querySelector('form');
    const submitButton = form.querySelector('button[type="submit"]');
    const originalButtonText = submitButton.innerHTML;

    form.addEventListener('submit', function() {
        // Change button text and show spinner
        submitButton.disabled = true;
        submitButton.innerHTML = `
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Uploading...
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
