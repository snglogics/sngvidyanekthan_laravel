@extends('layouts.admin')

@section('title', 'Kinder Gallery')

@section('content')

<!-- Include Bootstrap and FontAwesome if not already included -->
@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
    .upload-card {
        animation: fadeInUp 0.6s ease-in-out;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        padding: 30px;
        background-color: #fff;
    }

    @keyframes fadeInUp {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .upload-icon {
        font-size: 2rem;
        color: #007bff;
    }

    .form-group label {
        font-weight: 600;
    }

    .btn-upload {
        position: relative;
        transition: background 0.3s ease;
    }

    .btn-upload:hover {
        background-color: #0056b3 !important;
    }

    .form-note {
        font-size: 12px;
        color: #6c757d;
    }
</style>
@endpush

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="upload-card">
                <div class="text-center mb-4">
                    <i class="fa-solid fa-cloud-arrow-up upload-icon"></i>
                    <h3 class="mt-2">Upload Kindergarten Gallery Images</h3>
                </div>

                <form action="{{ route('admin.kinder.upload') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="common_header">Common Header <i class="fa-solid fa-heading ms-1"></i></label>
                        <input type="text" name="common_header" id="common_header" class="form-control" placeholder="Enter common header..." required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="images">Upload Images <i class="fa-solid fa-images ms-1"></i></label>
                        <input type="file" name="images[]" id="images" multiple required class="form-control">
                        <p class="form-note">Hold Ctrl (or Command on Mac) to select multiple images.</p>
                    </div>

                    <button type="submit" class="btn btn-primary btn-upload w-100" id="uploadBtn">
    <span class="default-text">
        <i class="fa-solid fa-upload me-2"></i>Upload
    </span>
    <span class="loading-text d-none">
        <span class="spinner-border spinner-border-sm me-2"></span>Uploading...
    </span>
</button>
                </form>

                @if(session('success'))
                    <div class="alert alert-success mt-4" role="alert">
                        <i class="fa-solid fa-check-circle me-2"></i> {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    const uploadForm = document.getElementById('uploadForm');
    const uploadBtn = document.getElementById('uploadBtn');

    uploadForm.addEventListener('submit', function () {
        uploadBtn.disabled = true;
        uploadBtn.querySelector('.default-text').classList.add('d-none');
        uploadBtn.querySelector('.loading-text').classList.remove('d-none');
    });
</script>
@endsection

@endsection
