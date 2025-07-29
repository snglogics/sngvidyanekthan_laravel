@extends('layouts.admin')

@section('title', 'Edit Assessment')
@section('breadcrumb-title', 'Academics')
@section('breadcrumb-link', route('admin.academics'))

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .form-container {
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .form-label i {
            color: #0d6efd;
            width: 1.25rem;
        }
        .current-pdf-link {
            transition: all 0.3s;
        }
        .current-pdf-link:hover {
            color: #0d6efd !important;
            transform: translateX(5px);
        }
        #submitBtn {
            transition: all 0.3s;
        }
        #submitBtn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-primary mb-0">
                        <i class="fas fa-clipboard-check me-2"></i>Edit Assessment
                    </h2>
                    <a href="{{ route('admin.assessments.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back to List
                    </a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li><i class="fas fa-exclamation-circle me-1"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-container p-4 mb-4">
                    <form id="editAssessmentForm" action="{{ route('admin.assessments.update', $assessment->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="classname" class="form-label">
                                <i class="fas fa-graduation-cap"></i> Class Name
                            </label>
                            <input type="text" name="classname" id="classname" class="form-control form-control-lg"
                                value="{{ old('classname', $assessment->classname) }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label d-block">
                                <i class="fas fa-file-pdf text-danger"></i> Current Assessment PDF
                            </label>
                            <a href="{{ $assessment->pdf_url }}" target="_blank" class="current-pdf-link text-decoration-none d-inline-block mb-2">
                                <i class="fas fa-eye me-1"></i> View Current Assessment
                            </a>
                            <br>
                            <a href="{{ route('admin.assessments.download', $assessment->id) }}" class="text-decoration-none">
                                <i class="fas fa-download me-1"></i> Download PDF
                            </a>
                        </div>

                        <div class="mb-4">
                            <label for="assessment_pdf" class="form-label">
                                <i class="fas fa-file-upload"></i> Update Assessment PDF (Optional)
                            </label>
                            <input type="file" name="assessment_pdf" id="assessment_pdf" 
                                   accept="application/pdf" class="form-control">
                            <small class="text-muted">Max file size: 2MB. Leave blank to keep current PDF.</small>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg py-3" id="submitBtn">
                                <i class="fas fa-save me-2"></i> Update Assessment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('editAssessmentForm');
            const submitBtn = document.getElementById('submitBtn');

            form.addEventListener('submit', function(e) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Saving Changes...
                `;
            });

            // Display toast notifications
            @if (session('success'))
                toastr.success("{{ session('success') }}", "Success", {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 5000
                });
            @elseif (session('error'))
                toastr.error("{{ session('error') }}", "Error", {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 5000
                });
            @endif

            // File input change handler
            const fileInput = document.getElementById('assessment_pdf');
            if (fileInput) {
                fileInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file && file.size > 2 * 1024 * 1024) {
                        toastr.error("File size exceeds 2MB limit", "Error");
                        this.value = '';
                    }
                });
            }
        });
    </script>
@endsection