@extends('layouts.admin')

@section('title', 'Edit Timetable')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center text-primary">Edit Timetable Entry</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="editForm" action="{{ route('admin.timetables.update', $timetable->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Class</label>
            <input type="text" name="classname" class="form-control" value="{{ old('classname', $timetable->classname) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Section</label>
            <input type="text" name="section" class="form-control" value="{{ old('section', $timetable->section) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Day</label>
            <select name="day" class="form-control" required>
                @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'] as $day)
                    <option value="{{ $day }}" {{ old('day', $timetable->day) == $day ? 'selected' : '' }}>{{ $day }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Period Number</label>
            <input type="number" name="period_number" class="form-control" value="{{ old('period_number', $timetable->period_number) }}" required min="1">
        </div>

        <div class="mb-3">
            <label class="form-label">Subject</label>
            <input type="text" name="subject" class="form-control" value="{{ old('subject', $timetable->subject) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Teacher Name</label>
            <input type="text" name="teacher_name" class="form-control" value="{{ old('teacher_name', $timetable->teacher_name) }}" required>
        </div>

        <div class="mb-3">
    <label class="form-label">Start Time</label>
    <input type="time" name="start_time" class="form-control"
        value="{{ old('start_time', \Carbon\Carbon::parse($timetable->start_time)->format('H:i')) }}" required>
</div>

<div class="mb-3">
    <label class="form-label">End Time</label>
    <input type="time" name="end_time" class="form-control"
        value="{{ old('end_time', \Carbon\Carbon::parse($timetable->end_time)->format('H:i')) }}" required>
</div>


        <div class="mb-3">
            <label class="form-label">Room Number</label>
            <input type="text" name="room_number" class="form-control" value="{{ old('room_number', $timetable->room_number) }}">
        </div>

        <button type="submit" class="btn btn-primary w-100" id="submitBtn">
            Update Entry
        </button>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    const form = document.getElementById('editForm');
    const submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', () => {
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...
        `;
    });

    @if (session('success'))
        toastr.success("{{ session('success') }}", "Success");
    @elseif (session('error'))
        toastr.error("{{ session('error') }}", "Error");
    @endif
</script>
@endsection
