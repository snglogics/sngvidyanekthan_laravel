@extends('layouts.admin')

@section('title', isset($curriculum) ? 'Edit Curriculum' : 'Add Curriculum')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4 text-primary">
        {{ isset($curriculum) ? 'Edit Curriculum' : 'Add Curriculum' }}
    </h2>

    <form action="{{ isset($curriculum) ? route('admin.curriculums.update', $curriculum->id) : route('admin.curriculums.store') }}" method="POST" enctype="multipart/form-data" id="curriculumForm">
        @csrf
        @if(isset($curriculum)) @method('PUT') @endif

        <div class="mb-3">
            <label for="class_group" class="form-label">Class Group</label>
            <select name="class_group" class="form-select" required>
                <option value="">Select Group</option>
                @foreach(['Kindergarten', 'Primary', 'Middle', 'High School'] as $group)
                    <option value="{{ $group }}" {{ (old('class_group', $curriculum->class_group ?? '') == $group) ? 'selected' : '' }}>
                        {{ $group }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="syllabus_file" class="form-label">Syllabus File (PDF)</label>
            <input type="file" name="syllabus_file" class="form-control" {{ isset($curriculum) ? '' : 'required' }}>
            @if(isset($curriculum) && $curriculum->syllabus_url)
                <small class="text-muted d-block mt-2">Current: <a href="{{ $curriculum->syllabus_url }}" target="_blank">View</a></small>
            @endif
        </div>

        <button type="submit" class="btn btn-primary w-100" id="submitBtn">
            {{ isset($curriculum) ? 'Update' : 'Submit' }}
        </button>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    const form = document.getElementById('curriculumForm');
    const submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', () => {
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...
        `;
    });

    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @elseif (session('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>
@endsection
