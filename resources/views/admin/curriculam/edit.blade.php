@extends('layouts.admin')

@section('title', 'Edit Curriculum')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4 text-primary">Edit Curriculum</h2>

    <form action="{{ route('admin.curriculums.update', $curriculum->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="class_group" class="form-label">Class Group</label>
            <select name="class_group" class="form-select" required>
                @foreach(['Kindergarten', 'Primary', 'Middle', 'High School'] as $group)
                    <option value="{{ $group }}" {{ $curriculum->class_group == $group ? 'selected' : '' }}>{{ $group }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="term" class="form-label">Term</label>
            <select name="term" class="form-select" required>
                @foreach($terms as $term)
                    <option value="{{ $term }}" {{ $curriculum->term == $term ? 'selected' : '' }}>{{ $term }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="subject" class="form-label">Subject</label>
            <input type="text" name="subject" class="form-control" value="{{ $curriculum->subject }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" required>{{ $curriculum->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="academic_year" class="form-label">Academic Year</label>
            <input type="text" name="academic_year" class="form-control" value="{{ $curriculum->academic_year }}" required>
        </div>

        <div class="mb-3">
            <label for="syllabus_file" class="form-label">Syllabus File (PDF)</label>
            <input type="file" name="syllabus_file" class="form-control">
            @if($curriculum->document_url)
                <small class="text-muted d-block mt-2">Current: <a href="{{ $curriculum->document_url }}" target="_blank">View PDF</a></small>
            @endif
        </div>

        <button type="submit" class="btn btn-primary w-100">Update</button>
    </form>
</div>
@endsection
