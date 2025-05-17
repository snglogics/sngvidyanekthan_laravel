@extends('layouts.admin')

@section('title', 'Add Curriculum')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4 text-primary">Add Curriculum</h2>

    <form action="{{ route('admin.curriculums.create') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="class_group" class="form-label">Class Group</label>
            <select name="class_group" class="form-select" required>
                <option value="">Select Group</option>
                @foreach(['Kindergarten', 'Primary', 'Middle', 'High School'] as $group)
                    <option value="{{ $group }}">{{ $group }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="term" class="form-label">Term</label>
            <select name="term" class="form-select" required>
                <option value="">Select Term</option>
                @foreach($terms as $term)
                    <option value="{{ $term }}">{{ $term }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="subject" class="form-label">Subject</label>
            <input type="text" name="subject" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="academic_year" class="form-label">Academic Year</label>
            <input type="text" name="academic_year" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="syllabus_file" class="form-label">Syllabus File (PDF)</label>
            <input type="file" name="syllabus_file" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary w-100">Submit</button>
    </form>
</div>
@endsection
