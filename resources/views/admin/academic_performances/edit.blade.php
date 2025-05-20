@extends('layouts.admin')

@section('title', 'Edit Academic Performance')
@section('breadcrumb-title', 'Achievements')
@section('breadcrumb-link', route('admin.achievements'))
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endsection

@section('content')
<div class="container my-5">
    <div class="card shadow-sm p-4">
        <h2 class="mb-4">Edit Academic Performance</h2>
        <form action="{{ route('admin.academic_performances.update', $academicPerformance->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.academic_performances._form', ['academicPerformance' => $academicPerformance])
            <button type="submit" class="btn btn-primary">Update Performance</button>
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
            const marks = marksInputs[index].value;
            if (subject.value && marks) {
                subjects[subject.value] = parseInt(marks);
            }
        });

        subjectsMarksTextarea.value = JSON.stringify(subjects);
    }

    addSubjectButton.addEventListener('click', function () {
        const subjectGroup = document.createElement('div');
        subjectGroup.classList.add('input-group', 'mb-2');
        subjectGroup.innerHTML = `
            <input type="text" name="subjects[]" placeholder="Subject" class="form-control" required>
            <input type="number" name="marks[]" placeholder="Marks" class="form-control" required>
            <button type="button" class="btn btn-danger remove-subject">Remove</button>
        `;
        subjectsContainer.appendChild(subjectGroup);
        updateSubjectsMarks();

        subjectGroup.querySelector('.remove-subject').addEventListener('click', function () {
            subjectGroup.remove();
            updateSubjectsMarks();
        });
    });

    subjectsContainer.addEventListener('input', updateSubjectsMarks);
});
</script>

@endsection
