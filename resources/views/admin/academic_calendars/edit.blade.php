@extends('layouts.admin')

@section('title', 'Edit Academic Event')

@section('content')
<form action="{{ route('academic-calendars.update', $academicCalendar->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Event Name</label>
        <input type="text" name="event_name" class="form-control" value="{{ $academicCalendar->event_name }}" required>
    </div>

    <div class="mb-3">
        <label>Start Date</label>
        <input type="date" name="start_date" class="form-control" value="{{ $academicCalendar->start_date }}" required>
    </div>

    <div class="mb-3">
        <label>End Date</label>
        <input type="date" name="end_date" class="form-control" value="{{ $academicCalendar->end_date }}">
    </div>

    <div class="mb-3">
        <label>Event Type</label>
        <input type="text" name="event_type" class="form-control" value="{{ $academicCalendar->event_type }}" required>
    </div>

    <div class="mb-3">
        <label>Academic Year</label>
        <input type="text" name="academic_year" class="form-control" value="{{ $academicCalendar->academic_year }}" required>
    </div>

    <div class="mb-3">
        <label>Audience</label>
        <input type="text" name="audience" class="form-control" value="{{ $academicCalendar->audience }}">
    </div>

    <div class="mb-3">
        <label>Color</label>
        <input type="color" name="color" class="form-control" value="{{ $academicCalendar->color }}">
    </div>

    <div class="mb-3">
        <label>Attachment (Optional)</label>
        <input type="file" name="attachment" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Update Event</button>
</form>
@endsection
