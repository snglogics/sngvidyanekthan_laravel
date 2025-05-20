@extends('layouts.admin')

@section('title', 'Edit Syllabus')
@section('breadcrumb-title', 'Academics')
@section('breadcrumb-link', route('admin.academics'))

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container py-5">
    <div class="card shadow-lg rounded-4 p-4">
        <h2 class="text-center mb-4 text-primary"><i class="fas fa-edit me-2"></i>Edit Syllabus</h2>

        <form action="{{ route('admin.syllabuses.update', $syllabus->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold"><i class="fas fa-school me-2 text-secondary"></i>Class Name</label>
                <input type="text" name="classname" class="form-control" value="{{ $syllabus->classname }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold"><i class="fas fa-layer-group me-2 text-secondary"></i>Section</label>
                <input type="text" name="section" class="form-control" value="{{ $syllabus->section }}">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold"><i class="fas fa-book me-2 text-secondary"></i>Subject</label>
                <input type="text" name="subject" class="form-control" value="{{ $syllabus->subject }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold"><i class="fas fa-align-left me-2 text-secondary"></i>Description</label>
                <textarea name="description" class="form-control" rows="4">{{ $syllabus->description }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold"><i class="fas fa-file-pdf me-2 text-secondary"></i>Current PDF</label><br>
                @if($syllabus->pdf_url)
                    <a href="{{ $syllabus->pdf_url }}" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-eye me-1"></i>View Current PDF
                    </a>
                @else
                    <span class="text-muted">N/A</span>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold"><i class="fas fa-upload me-2 text-secondary"></i>Upload New PDF (Optional)</label>
                <input type="file" name="pdf" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold"><i class="fas fa-calendar-alt me-2 text-secondary"></i>Academic Year</label>
                <input type="text" name="academic_year" class="form-control" value="{{ $syllabus->academic_year }}" required>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success px-4">
                    <i class="fas fa-save me-2"></i>Update Syllabus
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if (session('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>
@endsection
