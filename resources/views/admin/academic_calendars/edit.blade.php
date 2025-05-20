@extends('layouts.admin')

@section('title', 'Edit Academic Event')
@section('breadcrumb-title', 'Academics')
@section('breadcrumb-link', route('admin.academics'))

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container py-4">
    <div class="card shadow rounded">
        <div class="card-header bg-info text-white text-center">
            <h4><i class="bi bi-calendar2-event me-2"></i>Edit Academic Event</h4>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.academic-calendars.update', $academicCalendar->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-card-text me-1"></i> Event Name</label>
                    <input type="text" name="event_name" class="form-control" placeholder="Enter event name"
                           value="{{ $academicCalendar->event_name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-calendar-date me-1"></i> Start Date</label>
                    <input type="date" name="start_date" class="form-control"
                           value="{{ $academicCalendar->start_date }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-calendar2-week me-1"></i> End Date</label>
                    <input type="date" name="end_date" class="form-control"
                           value="{{ $academicCalendar->end_date }}">
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-tag me-1"></i> Event Type</label>
                    <input type="text" name="event_type" class="form-control" placeholder="e.g., Seminar, Exam"
                           value="{{ $academicCalendar->event_type }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-calendar-range me-1"></i> Academic Year</label>
                    <input type="text" name="academic_year" class="form-control" placeholder="e.g., 2024-2025"
                           value="{{ $academicCalendar->academic_year }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-people me-1"></i> Audience</label>
                    <input type="text" name="audience" class="form-control" placeholder="e.g., All Students, Faculty"
                           value="{{ $academicCalendar->audience }}">
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-palette me-1"></i> Event Color</label>
                    <input type="color" name="color" class="form-control form-control-color"
                           value="{{ $academicCalendar->color }}">
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-paperclip me-1"></i> Attachment (Optional)</label>
                    <input type="file" name="attachment" class="form-control">
                    @if($academicCalendar->attachment)
                        <div class="mt-2">
                            <a href="{{ asset('storage/'.$academicCalendar->attachment) }}" target="_blank" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-file-earmark-arrow-down me-1"></i> Current File
                            </a>
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-success w-100">
                    <i class="bi bi-save2 me-1"></i> Update Event
                </button>
            </form>

        </div>
    </div>
</div>
@endsection
