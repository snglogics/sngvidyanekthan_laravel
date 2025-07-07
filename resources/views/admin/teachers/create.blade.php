@extends('layouts.admin')

@section('title', 'Add New Teacher')
@section('breadcrumb-title', 'Faculty')
@section('breadcrumb-link', route('admin.faculties'))

@section('styles')
    <link href="{{ asset('frontend/css/uploadPrincipal.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .image-preview {
            display: none;
            width: 120px;
            height: 120px;
            margin-top: 10px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ced4da;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .card {
            border-radius: 1rem;
            box-shadow: 0 0.4rem 0.8rem rgba(0, 0, 0, 0.05);
        }

        .card-header {
            background-color: #0d6efd;
            color: #fff;
            border-radius: 1rem 1rem 0 0;
        }

        label i {
            margin-right: 6px;
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        <div class="card mx-auto" style="max-width: 700px;">
            <div class="card-header text-center">
                <h4 class="mb-0"><i class="fas fa-user-plus"></i> Add New Teacher</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.teachers.store') }}" method="POST" enctype="multipart/form-data"
                    id="teacherForm">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-user"></i> Name</label>
                        <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-briefcase"></i> Designation</label>
                        <input type="text" name="designation" class="form-control" placeholder="Assistant Professor"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-calendar-alt"></i> Years of Experience</label>
                        <input type="number" name="experience" class="form-control" placeholder="e.g. 5">
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-user-graduate"></i> Qualification</label>
                        <input type="text" name="qualification" class="form-control" placeholder="M.Sc., B.Ed.">
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-building"></i> Department</label>
                        <input type="text" name="department" class="form-control" placeholder="Science, Mathematics">
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-book"></i> Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="Physics, Chemistry">
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-align-left"></i> Description</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Write a short description..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-image"></i> Photo</label>
                        <input type="file" name="photo" class="form-control" accept="image/*"
                            onchange="previewImage(event)">
                        <div class="text-center">
                            <img id="image-preview" class="image-preview mt-2">
                        </div>
                    </div>

                    <button id="submitBtn" class="btn btn-success w-100 mt-3" type="submit" data-bs-toggle="tooltip"
                        title="Click to save teacher info">
                        <i class="fas fa-save me-1"></i> Add Teacher
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('image-preview');
            if (file) {
                const reader = new FileReader();
                reader.onload = () => {
                    preview.src = reader.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }

        document.getElementById('teacherForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status"></span> Saving...`;
        });

        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @elseif (session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>
@endsection
