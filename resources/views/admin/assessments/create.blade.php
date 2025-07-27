@extends('layouts.admin')

@section('title', 'Add Assessment')
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .input-group .remove-subject {
            white-space: nowrap;
        }
    </style>
@endsection

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white d-flex align-items-center">
            <i class="bi bi-calendar-plus me-2 fs-4"></i>
            <h4 class="mb-0">Add Assessment</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.assessments.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="assessment_date">Month & Date</label>
                    <input type="date" name="assessment_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Type of Assessment</label>
                    <input type="text" name="assessment_type" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Class</label>
                    <input type="text" name="class" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Marks</label>
                    <input type="number" name="marks" class="form-control" >
                </div>

                <div class="mb-3">
                    <label>Duration</label>
                    <input type="text" name="duration" class="form-control" >
                </div>

                <div class="mb-3">
                    <label>Open House</label>
                    <input type="text" name="open_house" class="form-control">
                </div>

                <button type="submit" class="btn btn-success w-100">
                    <i class="bi bi-upload me-1"></i> Submit
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
