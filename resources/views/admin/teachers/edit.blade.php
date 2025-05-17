@extends('layouts.admin')

@section('title', 'Edit Academic Performance')

@section('styles')
<style>
    .form-container {
        background-color: #f8f9fa;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .form-container h2 {
        color: #007bff;
        margin-bottom: 20px;
    }

    .image-preview {
        margin-top: 15px;
        width: 150px;
        height: 150px;
        border-radius: 10px;
        object-fit: cover;
        display: block;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="form-container">
        <h2>Edit Academic Performance</h2>
        <form action="{{ route('admin.academic_performances.update', $academicPerformance->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Student Name</label>
                <input type="text" name="student_name" class="form-control" value="{{ $academicPerformance->student_name }}" required>
            </div>

            <div class="mb-3">
                <label>Roll Number</label>
                <input type="text" name="roll_number" class="form-control" value="{{ $academicPerformance->roll_number }}" required>
            </div>

            <div class="mb-3">
                <label>Subjects and Marks (JSON Format)</label>
                <textarea name="subjects_marks" class="form-control" rows="4" required>{{ json_encode($academicPerformance->subjects_marks) }}</textarea>
            </div>

            <div class="mb-3">
                <label>Total Marks</label>
                <input type="number" name="total_marks" class="form-control" value="{{ $academicPerformance->total_marks }}" required>
            </div>

            <div class="mb-3">
                <label>Percentage</label>
                <input type="number" name="percentage" class="form-control" value="{{ $academicPerformance->percentage }}" required>
            </div>

            <div class="mb-3">
                <label>Grade</label>
                <input type="text" name="grade" class="form-control" value="{{ $academicPerformance->grade }}" required>
            </div>

            <div class="mb-3">
                <label>Image</label>
                <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
                @if($academicPerformance->image_url)
                    <img src="{{ $academicPerformance->image_url }}" id="image-preview" class="image-preview">
                @else
                    <img id="image-preview" class="image-preview" style="display: none;">
                @endif
            </div>

            <button class="btn btn-primary w-100">Update Performance</button>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('image-preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function() {
                preview.src = reader.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
