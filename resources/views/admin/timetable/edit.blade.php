@extends('layouts.admin')

@section('title', 'Edit Timetable')
@section('breadcrumb-title', 'Academics')
@section('breadcrumb-link', route('admin.academics'))

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    input.form-control, select.form-select {
    border-radius: 0.5rem;
}
label.form-label i {
    color: #0d6efd;
}
</style>
@endsection

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center text-primary"><i class="fas fa-calendar-edit me-2"></i>Edit Timetable Entry</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li><i class="fas fa-exclamation-circle text-danger me-1"></i>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="editForm" action="{{ route('admin.timetables.update', $timetable->id) }}" method="POST" class="shadow p-4 rounded bg-light">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Class <i class="fas fa-chalkboard ms-1"></i></label>
                <input type="text" name="classname" class="form-control" value="{{ old('classname', $timetable->classname) }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Section <i class="fas fa-layer-group ms-1"></i></label>
                <input type="text" name="section" class="form-control" value="{{ old('section', $timetable->section) }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Day <i class="fas fa-calendar-day ms-1"></i></label>
                <select name="day" class="form-select" required>
                    @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'] as $day)
                        <option value="{{ $day }}" {{ old('day', $timetable->day) == $day ? 'selected' : '' }}>{{ $day }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Period Number <i class="fas fa-hashtag ms-1"></i></label>
                <input type="number" name="period_number" class="form-control" value="{{ old('period_number', $timetable->period_number) }}" required min="1">
            </div>

            <div class="col-md-6">
                <label class="form-label">Subject <i class="fas fa-book ms-1"></i></label>
                <input type="text" name="subject" class="form-control" value="{{ old('subject', $timetable->subject) }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Teacher Name <i class="fas fa-user ms-1"></i></label>
                <input type="text" name="teacher_name" class="form-control" value="{{ old('teacher_name', $timetable->teacher_name) }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Start Time <i class="fas fa-clock ms-1"></i></label>
                <input type="time" name="start_time" class="form-control" value="{{ old('start_time', \Carbon\Carbon::parse($timetable->start_time)->format('H:i')) }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">End Time <i class="fas fa-clock ms-1"></i></label>
                <input type="time" name="end_time" class="form-control" value="{{ old('end_time', \Carbon\Carbon::parse($timetable->end_time)->format('H:i')) }}" required>
            </div>

            <div class="col-md-12">
                <label class="form-label">Room Number (Optional) <i class="fas fa-door-open ms-1"></i></label>
                <input type="text" name="room_number" class="form-control" value="{{ old('room_number', $timetable->room_number) }}">
            </div>
        </div>

        <button type="submit" class="btn btn-success w-100 mt-4" id="submitBtn">
            <i class="fas fa-save me-2"></i>Update Timetable
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
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Updating...
        `;
    });

    @if (session('success'))
        toastr.success("{{ session('success') }}", "Success");
    @elseif (session('error'))
        toastr.error("{{ session('error') }}", "Error");
    @endif
</script>
@endsection
