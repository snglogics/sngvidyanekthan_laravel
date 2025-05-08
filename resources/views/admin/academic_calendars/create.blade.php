@extends('layouts.admin')

@section('title', 'Add New Academic Event')

@section('content')
<form action="{{ route('academic-calendars.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Event Name</label>
        <input type="text" name="event_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Start Date</label>
        <input type="date" name="start_date" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>End Date</label>
        <input type="date" name="end_date" class="form-control">
    </div>

    <div class="mb-3">
        <label>Event Type</label>
        <input type="text" name="event_type" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Academic Year</label>
        <input type="text" name="academic_year" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Audience</label>
        <input type="text" name="audience" class="form-control">
    </div>

    <div class="mb-3">
        <label>Color</label>
        <input type="color" name="color" class="form-control" value="#007bff">
    </div>

    <div class="mb-3">
        <label>Attachment (Optional)</label>
        <input type="file" name="attachment" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Save Event</button>
</form>
@endsection
