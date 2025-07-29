@extends('layouts.admin')

@section('title', 'Create Assessment')
@section('breadcrumb-title', 'Academics')
@section('breadcrumb-link', route('admin.academics'))

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .upload-area {
            border: 2px dashed #dee2e6;
            border-radius: 5px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 1rem;
        }
        .upload-area:hover {
            border-color: #0d6efd;
            background-color: #f8f9fa;
        }
        .file-info {
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #6c757d;
        }
        #pdfPreview {
            max-width: 100%;
            max-height: 300px;
            display: none;
            margin-top: 1rem;
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex align-items-center">
                <i class="fas fa-clipboard-check me-2"></i>
                <h5 class="mb-0">Upload New Assessment</h5>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li><i class="fas fa-exclamation-circle me-1"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="assessmentForm" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="classname" class="form-label">
                            <i class="fas fa-graduation-cap me-1"></i> Class Name
                        </label>
                        <input type="text" name="classname" class="form-control" 
                               placeholder="e.g. 10th Grade, LKG, UKG" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-file-pdf me-1"></i> Assessment PDF
                        </label>
                        <div class="upload-area" id="uploadArea">
                            <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-2"></i>
                            <p class="mb-1">Drag & drop your PDF here or click to browse</p>
                            <p class="file-info" id="fileInfo">No file selected</p>
                            <input type="file" name="assessment_pdf" id="assessment_pdf" 
                                   accept="application/pdf" class="d-none" required>
                            <div id="pdfPreviewContainer">
                                <embed id="pdfPreview" type="application/pdf">
                            </div>
                        </div>
                        <small class="text-muted">Max file size: 2MB | PDF only</small>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-upload me-1"></i> Upload Assessment
                        </button>
                        <a href="{{ route('admin.assessments.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // File upload area interaction
            const uploadArea = $('#uploadArea');
            const fileInput = $('#assessment_pdf');
            const fileInfo = $('#fileInfo');
            const pdfPreview = $('#pdfPreview');
            const form = $('#assessmentForm');
            const submitBtn = $('#submitBtn');

            // Handle click on upload area
            uploadArea.on('click', function() {
                fileInput.trigger('click');
            });

            // Handle file selection
            fileInput.on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    fileInfo.text(file.name);
                    
                    // Show PDF preview (simple version - full preview would require PDF.js)
                    if (file.type === 'application/pdf') {
                        const fileURL = URL.createObjectURL(file);
                        pdfPreview.attr('src', fileURL).show();
                    }
                } else {
                    fileInfo.text('No file selected');
                    pdfPreview.hide();
                }
            });

            // Handle drag and drop
            uploadArea.on('dragover', function(e) {
                e.preventDefault();
                $(this).addClass('border-primary bg-light');
            });

            uploadArea.on('dragleave', function(e) {
                e.preventDefault();
                $(this).removeClass('border-primary bg-light');
            });

            uploadArea.on('drop', function(e) {
                e.preventDefault();
                $(this).removeClass('border-primary bg-light');
                
                const files = e.originalEvent.dataTransfer.files;
                if (files.length > 0 && files[0].type === 'application/pdf') {
                    fileInput[0].files = files;
                    fileInfo.text(files[0].name);
                    
                    // Show PDF preview
                    const fileURL = URL.createObjectURL(files[0]);
                    pdfPreview.attr('src', fileURL).show();
                }
            });

            // Form submission
            form.on('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                submitBtn.prop('disabled', true);
                submitBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Uploading...');

                $.ajax({
                    url: "{{ route('admin.assessments.store') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message || "Assessment uploaded successfully");
                            setTimeout(() => {
                                window.location.href = response.redirect || "{{ route('admin.assessments.index') }}";
                            }, 1500);
                        } else {
                            toastr.error(response.message || "Failed to upload assessment");
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                toastr.error(value[0]);
                            });
                        } else {
                            toastr.error("An unexpected error occurred");
                        }
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false);
                        submitBtn.html('<i class="fas fa-upload me-1"></i> Upload Assessment');
                    }
                });
            });
        });
    </script>
@endsection