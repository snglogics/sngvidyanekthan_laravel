@extends('layouts.admin')

@section('title', 'Add New Syllabus')
@section('breadcrumb-title', 'Academics')
@section('breadcrumb-link', route('admin.academics'))
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<style>
    .form-label {
        font-size: 0.95rem;
    }

    textarea.form-control {
        resize: none;
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        border-color: #86b7fe;
    }

    .btn-primary:disabled {
        opacity: 0.8;
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-body p-5">
                    <h2 class="text-center text-primary mb-4">
                        <i class="fas fa-book-open me-2"></i> Add New Syllabus
                    </h2>

                    <form action="{{ route('admin.syllabuses.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-semibold"><i class="fas fa-school me-1 text-secondary"></i> Class Name</label>
                            <input type="text" name="classname" class="form-control rounded-pill" placeholder="Enter class name" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold"><i class="fas fa-layer-group me-1 text-secondary"></i> Section</label>
                            <input type="text" name="section" class="form-control rounded-pill" placeholder="Enter section">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold"><i class="fas fa-book me-1 text-secondary"></i> Subject</label>
                            <input type="text" name="subject" class="form-control rounded-pill" placeholder="Enter subject" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold"><i class="fas fa-align-left me-1 text-secondary"></i> Description</label>
                            <textarea name="description" class="form-control rounded-4" rows="4" placeholder="Write a brief description..."></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold"><i class="fas fa-file-pdf me-1 text-secondary"></i> PDF File (Optional)</label>
                            <input type="file" name="pdf" class="form-control">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold"><i class="fas fa-calendar-alt me-1 text-secondary"></i> Academic Year</label>
                            <input type="text" name="academic_year" class="form-control rounded-pill" placeholder="E.g., 2024-2025" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary rounded-pill fw-semibold">
                                <i class="fas fa-save me-2"></i> Save Syllabus
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.querySelector('form');
        const submitBtn = form.querySelector('button[type="submit"]');

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            submitBtn.disabled = true;
            submitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Saving...`;
            setTimeout(() => form.submit(), 100);
        });

        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    });
</script>
@endsection

