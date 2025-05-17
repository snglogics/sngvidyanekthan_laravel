@extends('layouts.admin')

@section('title', 'Edit Interschool Participation')

@section('content')
<div class="container py-4">
    <h2>Edit Participation</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.interschool-participations.update', $interschoolParticipation) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="student_name" class="form-label">Student Name <span class="text-danger">*</span></label>
            <input type="text" id="student_name" name="student_name" class="form-control" required value="{{ old('student_name', $interschoolParticipation->student_name) }}">
        </div>

        <div class="mb-3">
            <label for="event_name" class="form-label">Event Name <span class="text-danger">*</span></label>
            <input type="text" id="event_name" name="event_name" class="form-control" required value="{{ old('event_name', $interschoolParticipation->event_name) }}">
        </div>

        <div class="mb-3">
            <label for="event_date" class="form-label">Event Date <span class="text-danger">*</span></label>
            <input type="date" id="event_date" name="event_date" class="form-control" required value="{{ old('event_date', $interschoolParticipation->event_date->format('Y-m-d')) }}">
        </div>

        <div class="mb-3">
            <label for="position" class="form-label">Position</label>
            <input type="text" id="position" name="position" class="form-control" value="{{ old('position', $interschoolParticipation->position) }}">
            <small class="form-text text-muted">E.g., 1st, 2nd, Participant</small>
        </div>

        <div class="mb-3">
            <label for="school_name" class="form-label">School Name <span class="text-danger">*</span></label>
            <input type="text" id="school_name" name="school_name" class="form-control" required value="{{ old('school_name', $interschoolParticipation->school_name) }}">
        </div>

        <div class="mb-3">
            <label for="remarks" class="form-label">Remarks</label>
            <textarea id="remarks" name="remarks" class="form-control" rows="3">{{ old('remarks', $interschoolParticipation->remarks) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Photo (optional)</label>
            @if($interschoolParticipation->photo_url)
                <div class="mb-2">
                    <img src="{{ $interschoolParticipation->photo_url }}" alt="Current Photo" style="height: 150px; object-fit: cover; border-radius: 5px;">
                </div>
            @endif
            <input type="file" id="photo" name="photo" class="form-control" accept="image/*">
            <small class="form-text text-muted">Upload to replace existing photo.</small>
        </div>

        <button type="submit" class="btn btn-primary">Update Participation</button>
        <a href="{{ route('admin.interschool-participations.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>
@endsection
