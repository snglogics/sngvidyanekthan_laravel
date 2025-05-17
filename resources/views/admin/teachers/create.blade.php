@extends('layouts.admin')

@section('title', 'Add New Teacher')

@section('styles')
<link href="{{ asset('frontend/css/uploadPrincipal.css') }}" rel="stylesheet">
<style>
   
</style>
@endsection

@section('content')
<div class="container">
    <div class="teacher-form">
        <h2>Add New Teacher</h2>
        <form action="{{ route('teachers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Designation</label>
                <input type="text" name="designation" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Years of Experience</label>
                <input type="number" name="experience" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Qualification</label>
                <input type="text" name="qualification" class="form-control" placeholder="e.g., M.Sc., B.Ed.">
            </div>
            <div class="mb-3">
                <label>Department</label>
                <input type="text" name="department" class="form-control" placeholder="e.g., Science, Mathematics">
            </div>
            <div class="mb-3">
                <label>Subject</label>
                <input type="text" name="subject" class="form-control" placeholder="e.g., Physics, Chemistry, Biology">
            </div>
            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Write a short description about the teacher's background and teaching philosophy"></textarea>
            </div>
            <div class="mb-3">
                <label>Photo</label>
                <input type="file" name="photo" class="form-control" accept="image/*" onchange="previewImage(event)">
                <img id="image-preview" class="image-preview">
            </div>
            <button class="btn btn-success w-100">Add Teacher</button>
        </form>
    </div>
</div>

<!-- Image Preview Script -->
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
