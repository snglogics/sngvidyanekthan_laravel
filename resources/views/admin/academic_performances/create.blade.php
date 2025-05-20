@extends('layouts.admin')

@section('title', 'Add Academic Performance')
@section('breadcrumb-title', 'Achievements')
@section('breadcrumb-link', route('admin.achievements'))

@section('styles')
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body {
        background-color: #f8f9fa;
    }
    .card {
        border-radius: 10px;
        border: 1px solid #dee2e6;
    }
    .btn-outline-danger, .btn-outline-secondary {
        white-space: nowrap;
    }
</style>
@endsection
@section('content')
<div class="container my-5">
    <div class="card shadow-sm p-4">
        <h2 class="mb-4 text-center">Add Academic Performance</h2>

        <form action="{{ route('admin.academic_performances.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @include('admin.academic_performances._form')

            <div class="mb-3">
                <label class="form-label">Subjects and Marks</label>
                <div id="subjects-container" class="mb-2">
                    <!-- Subject fields will be added here -->
                </div>
                <button type="button" id="add-subject" class="btn btn-outline-secondary mb-3">
                    <i class="bi bi-plus-circle"></i> Add Subject
                </button>
                <!-- Hidden textarea to store JSON -->
                <textarea id="subjects_marks" name="subjects_marks" class="d-none"></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-save"></i> Add Performance
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const addSubjectButton = document.getElementById('add-subject');
    const subjectsContainer = document.getElementById('subjects-container');
    const subjectsMarksTextarea = document.getElementById('subjects_marks');

    function updateSubjectsMarks() {
        const subjects = {};
        const subjectInputs = document.querySelectorAll('input[name="subjects[]"]');
        const marksInputs = document.querySelectorAll('input[name="marks[]"]');

        subjectInputs.forEach((subject, index) => {
            const marks = marksInputs[index]?.value;
            if (subject.value && marks) {
                subjects[subject.value] = parseInt(marks);
            }
        });

        subjectsMarksTextarea.value = JSON.stringify(subjects);
    }

    function addSubjectField() {
        const subjectGroup = document.createElement('div');
        subjectGroup.classList.add('input-group', 'mb-2');
        subjectGroup.innerHTML = `
            <input type="text" name="subjects[]" placeholder="Subject" class="form-control" required>
            <input type="number" name="marks[]" placeholder="Marks" class="form-control" required>
            <button type="button" class="btn btn-outline-danger remove-subject">Remove</button>
        `;

        subjectsContainer.appendChild(subjectGroup);
        updateSubjectsMarks();

        subjectGroup.querySelector('.remove-subject').addEventListener('click', function () {
            subjectGroup.remove();
            updateSubjectsMarks();
        });

        subjectGroup.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', updateSubjectsMarks);
        });
    }

    addSubjectButton.addEventListener('click', addSubjectField);

    // Initialize with one subject row
    addSubjectField();
});
</script>
<!-- Bootstrap 5 JS (optional but useful for dropdowns, modals, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
