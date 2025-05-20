@extends('layouts.admin')

@section('title', 'Add Interschool Participation')
@section('breadcrumb-title', 'Activities')
@section('breadcrumb-link', route('admin.activities'))

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endsection

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-person-plus-fill me-2"></i>Add Participation</h5>
            <a href="{{ route('admin.interschool-participations.index') }}" class="btn btn-sm btn-light">
                <i class="bi bi-arrow-left-circle me-1"></i>Back
            </a>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li><i class="bi bi-exclamation-circle-fill me-2"></i>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('admin.interschool-participations.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                @csrf

                <div class="col-md-6">
                    <label for="student_name" class="form-label">Student Name <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" id="student_name" name="student_name" class="form-control" required value="{{ old('student_name') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="event_name" class="form-label">Event Name <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-trophy-fill"></i></span>
                        <input type="text" id="event_name" name="event_name" class="form-control" required value="{{ old('event_name') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="event_date" class="form-label">Event Date <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-calendar-event-fill"></i></span>
                        <input type="date" id="event_date" name="event_date" class="form-control" required value="{{ old('event_date') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="position" class="form-label">Position</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-award-fill"></i></span>
                        <input type="text" id="position" name="position" class="form-control" value="{{ old('position') }}">
                    </div>
                    <small class="form-text text-muted">E.g., 1st, 2nd, Participant</small>
                </div>

                <div class="col-md-6">
                    <label for="school_name" class="form-label">School Name <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-building"></i></span>
                        <input type="text" id="school_name" name="school_name" class="form-control" required value="{{ old('school_name') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="photo" class="form-label">Photo</label>
                    <input type="file" id="photo" name="photo" class="form-control" accept="image/*">
                </div>

                <div class="col-12">
                    <label for="remarks" class="form-label">Remarks</label>
                    <textarea id="remarks" name="remarks" class="form-control" rows="3" placeholder="Optional notes...">{{ old('remarks') }}</textarea>
                </div>

                <div class="col-12 d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save me-1"></i> Save
                    </button>
                    <a href="{{ route('admin.interschool-participations.index') }}" class="btn btn-secondary ms-2">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
