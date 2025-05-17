@extends('layouts.admin')

@section('title', 'Edit Syllabus')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Edit Syllabus</h2>

    <form action="{{ route('admin.syllabuses.update', $syllabus->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Class Name</label>
            <input type="text" name="classname" class="form-control" value="{{ $syllabus->classname }}" required>
        </div>

        <div class="mb-3">
            <label>Section</label>
            <input type="text" name="section" class="form-control" value="{{ $syllabus->section }}">
        </div>

        <div class="mb-3">
            <label>Subject</label>
            <input type="text" name="subject" class="form-control" value="{{ $syllabus->subject }}" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4">{{ $syllabus->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Current PDF</label><br>
            @if($syllabus->pdf_url)
                <a href="{{ $syllabus->pdf_url }}" target="_blank">View Current PDF</a>
            @else
                N/A
            @endif
        </div>

        <div class="mb-3">
            <label>Upload New PDF (Optional)</label>
            <input type="file" name="pdf" class="form-control">
        </div>

        <div class="mb-3">
            <label>Academic Year</label>
            <input type="text" name="academic_year" class="form-control" value="{{ $syllabus->academic_year }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update Syllabus</button>
    </form>
</div>
@endsection
