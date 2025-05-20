@extends('layouts.admin')

@section('title', 'Edit Interschool Participation')
@section('breadcrumb-title', 'Activities')
@section('breadcrumb-link', route('admin.activities'))

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endsection

@section('content')
<div class="container py-4">
    <div class="card shadow-sm rounded">
        <div class="card-body">
            <h4 class="mb-4"><i class="bi bi-pencil-square me-2 text-primary"></i>Edit Interschool Participation</h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li><i class="bi bi-exclamation-circle-fill me-1"></i>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.interschool-participations.update', $interschoolParticipation) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="student_name" class="form-label"><i class="bi bi-person-fill me-1 text-secondary"></i>Student Name <span class="text-danger">*</span></label>
                    <input type="text" id="student_name" name="student_name" class="form-control" required value="{{ old('student_name', $interschoolParticipation->student_name) }}">
                </div>

                <div class="mb-3">
                    <label for="event_name" class="form-label"><i class="bi bi-calendar-event me-1 text-secondary"></i>Event Name <span class="text-danger">*</span></label>
                    <input type="text" id="event_name" name="event_name" class="form-control" required value="{{ old('event_name', $interschoolParticipation->event_name) }}">
                </div>

                <div class="mb-3">
                    <label for="event_date" class="form-label"><i class="bi bi-calendar-date me-1 text-secondary"></i>Event Date <span class="text-danger">*</span></label>
                    <input type="date" id="event_date" name="event_date" class="form-control" required value="{{ old('event_date', $interschoolParticipation->event_date->format('Y-m-d')) }}">
                </div>

                <div class="mb-3">
                    <label for="position" class="form-label"><i class="bi bi-award-fill me-1 text-secondary"></i>Position</label>
                    <input type="text" id="position" name="position" class="form-control" value="{{ old('position', $interschoolParticipation->position) }}">
                    <small class="form-text text-muted">E.g., 1st, 2nd, Participant</small>
                </div>

                <div class="mb-3">
                    <label for="school_name" class="form-label"><i class="bi bi-building me-1 text-secondary"></i>School Name <span class="text-danger">*</span></label>
                    <input type="text" id="school_name" name="school_name" class="form-control" required value="{{ old('school_name', $interschoolParticipation->school_name) }}">
                </div>

                <div class="mb-3">
                    <label for="remarks" class="form-label"><i class="bi bi-chat-left-text me-1 text-secondary"></i>Remarks</label>
                    <textarea id="remarks" name="remarks" class="form-control" rows="3">{{ old('remarks', $interschoolParticipation->remarks) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label"><i class="bi bi-image-fill me-1 text-secondary"></i>Photo (optional)</label>
                    @if($interschoolParticipation->photo_url)
                        <div class="mb-2">
                            <img src="{{ $interschoolParticipation->photo_url }}" alt="Current Photo" style="height: 150px; object-fit: cover; border-radius: 5px;">
                        </div>
                    @endif
                    <input type="file" id="photo" name="photo" class="form-control" accept="image/*">
                    <small class="form-text text-muted">Upload to replace existing photo.</small>
                </div>

                <div class="d-flex">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-save-fill me-1"></i>Update Participation
                    </button>
                    <a href="{{ route('admin.interschool-participations.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-1"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
