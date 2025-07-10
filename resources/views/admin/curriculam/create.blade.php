@extends('layouts.admin')

@section('title', 'Add Curriculum')
@section('breadcrumb-title', 'Academics')
@section('breadcrumb-link', route('admin.academics'))

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container py-5">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-primary text-white rounded-top-4 d-flex align-items-center">
                <i class="bi bi-journal-plus fs-4 me-2"></i>
                <h4 class="mb-0">Assessment Pattern</h4>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.curriculums.store') }}" method="POST" enctype="multipart/form-data"
                    id="curriculumForm">
                    @csrf

                    <div class="mb-3">
                        <label for="class_group" class="form-label">Class Group</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-people-fill"></i></span>
                            <select name="class_group" class="form-select" required>
                                <option value="">Select Group</option>
                                @foreach (['Kindergarten', 'Primary', 'Middle', 'High School'] as $group)
                                    <option value="{{ $group }}">{{ $group }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="term" class="form-label">Term</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                            <select name="term" class="form-select" required>
                                <option value="">Select Term</option>
                                @foreach ($terms as $term)
                                    <option value="{{ $term }}">{{ $term }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-book"></i></span>
                            <input type="text" name="subject" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                            <textarea name="description" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="academic_year" class="form-label">Academic Year</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar-range"></i></span>
                            <input type="text" name="academic_year" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="syllabus_file" class="form-label">Syllabus File (PDF)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-file-earmark-pdf"></i></span>
                            <input type="file" name="syllabus_file" class="form-control" accept="application/pdf">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success w-100 rounded-3" id="submitBtn">
                        <i class="bi bi-upload me-2"></i><span id="submitText">Submit</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('curriculumForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');

            // Disable button and update text/icon
            submitBtn.disabled = true;
            submitText.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Submitting...';
        });
    </script>
@endsection
