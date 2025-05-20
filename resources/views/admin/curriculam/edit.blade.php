@extends('layouts.admin')

@section('title', 'Edit Curriculum')
@section('breadcrumb-title', 'Academics')
@section('breadcrumb-link', route('admin.academics'))

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endsection

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4 d-flex align-items-center">
            <i class="bi bi-pencil-square fs-4 me-2"></i>
            <h4 class="mb-0">Edit Curriculum</h4>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('admin.curriculums.update', $curriculum->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="class_group" class="form-label">
                        <i class="bi bi-grid-3x3-gap-fill me-1"></i>Class Group
                    </label>
                    <select name="class_group" class="form-select" required>
                        @foreach(['Kindergarten', 'Primary', 'Middle', 'High School'] as $group)
                            <option value="{{ $group }}" {{ $curriculum->class_group == $group ? 'selected' : '' }}>{{ $group }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="term" class="form-label">
                        <i class="bi bi-calendar-week me-1"></i>Term
                    </label>
                    <select name="term" class="form-select" required>
                        @foreach($terms as $term)
                            <option value="{{ $term }}" {{ $curriculum->term == $term ? 'selected' : '' }}>{{ $term }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="subject" class="form-label">
                        <i class="bi bi-book-half me-1"></i>Subject
                    </label>
                    <input type="text" name="subject" class="form-control" value="{{ $curriculum->subject }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">
                        <i class="bi bi-card-text me-1"></i>Description
                    </label>
                    <textarea name="description" class="form-control" rows="4" required>{{ $curriculum->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="academic_year" class="form-label">
                        <i class="bi bi-clock-history me-1"></i>Academic Year
                    </label>
                    <input type="text" name="academic_year" class="form-control" value="{{ $curriculum->academic_year }}" required>
                </div>

                <div class="mb-4">
                    <label for="syllabus_file" class="form-label">
                        <i class="bi bi-file-earmark-pdf me-1"></i>Syllabus File (PDF)
                    </label>
                    <input type="file" name="syllabus_file" class="form-control" accept="application/pdf">
                    @if($curriculum->document_url)
                        <small class="text-muted d-block mt-2">
                            <i class="bi bi-file-earmark-text me-1"></i>Current: <a href="{{ $curriculum->document_url }}" target="_blank">View PDF</a>
                        </small>
                    @endif
                </div>

                <button type="submit" class="btn btn-success w-100 rounded-3">
                    <i class="bi bi-save me-2"></i>Update
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
