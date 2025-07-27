@extends('layouts.admin')

@section('title', 'Edit Assessment')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-warning text-white d-flex align-items-center">
            <i class="bi bi-pencil-square me-2 fs-4"></i>
            <h4 class="mb-0">Edit Assessment</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.assessments.update', $assessment->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="assessment_date">Month & Date</label>
                    <input type="date" name="assessment_date" class="form-control"
                        value="{{ old('assessment_date', $assessment->assessment_date) }}" required>
                </div>

                <div class="mb-3">
                    <label>Type of Assessment</label>
                    <input type="text" name="assessment_type" class="form-control"
                        value="{{ old('assessment_type', $assessment->assessment_type) }}" required>
                </div>

                <div class="mb-3">
                    <label>Class</label>
                    <input type="text" name="class" class="form-control"
                        value="{{ old('class', $assessment->class) }}" required>
                </div>

                <div class="mb-3">
                    <label>Marks</label>
                    <input type="number" name="marks" class="form-control"
                        value="{{ old('marks', $assessment->marks) }}" >
                </div>

                <div class="mb-3">
                    <label>Duration</label>
                    <input type="text" name="duration" class="form-control"
                        value="{{ old('duration', $assessment->duration) }}" >
                </div>

                <div class="mb-3">
                    <label>Open House</label>
                    <input type="text" name="open_house" class="form-control"
                        value="{{ old('open_house', $assessment->open_house) }}">
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-save me-1"></i> Update
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
