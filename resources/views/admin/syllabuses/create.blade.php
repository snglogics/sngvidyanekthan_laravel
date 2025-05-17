@extends('layouts.admin')

@section('title', 'Add New Syllabus')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Add New Syllabus</h2>

    <form action="{{ route('admin.syllabuses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Class Name</label>
            <input type="text" name="classname" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Section</label>
            <input type="text" name="section" class="form-control">
        </div>

        <div class="mb-3">
            <label>Subject</label>
            <input type="text" name="subject" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label>PDF File (Optional)</label>
            <input type="file" name="pdf" class="form-control">
        </div>

        <div class="mb-3">
            <label>Academic Year</label>
            <input type="text" name="academic_year" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Syllabus</button>
    </form>
</div>
@endsection
