@extends('layouts.admin')

@section('title', 'Add New Academic Event')
@section('breadcrumb-title', 'Academics')
@section('breadcrumb-link', route('admin.academics'))

@section('styles')
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endsection

@section('content')
    <div class="card shadow-lg border-0 p-4 animate__animated animate__fadeIn">
        <h3 class="mb-4 text-primary fw-bold">
            <i class="bi bi-calendar-plus me-2"></i> Add New Academic Event
        </h3>

        <form action="{{ route('admin.academic-calendars.store') }}" method="POST" enctype="multipart/form-data"
            id="eventForm">
            @csrf

            {{-- Event Name --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    <i class="bi bi-pencil-square me-1 text-secondary"></i> Event Name
                </label>
                <input type="text" name="event_name" class="form-control shadow-sm" placeholder="Enter event name"
                    required>
            </div>

            {{-- Description --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    <i class="bi bi-chat-left-text me-1 text-secondary"></i> Day
                </label>
                <textarea name="description" class="form-control shadow-sm" rows="3" placeholder="eg: Saturday"></textarea>
            </div>

            {{-- Date Range --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-calendar-event me-1 text-secondary"></i> Start Date
                    </label>
                    <input type="date" name="start_date" class="form-control shadow-sm" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-calendar-check me-1 text-secondary"></i> End Date
                    </label>
                    <input type="date" name="end_date" class="form-control shadow-sm">
                </div>
            </div>

            {{-- Event Type --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    <i class="bi bi-tags me-1 text-secondary"></i> Month
                </label>
                <input type="text" name="event_type" class="form-control shadow-sm" placeholder="Workshop, Seminar, etc."
                    required>
            </div>

            {{-- Academic Year --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    <i class="bi bi-journal-bookmark me-1 text-secondary"></i> Academic Year
                </label>
                <input type="text" name="academic_year" class="form-control shadow-sm" placeholder="e.g. 2024-2025"
                    required>
            </div>

            {{-- Audience --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    <i class="bi bi-people me-1 text-secondary"></i> Audience
                </label>
                <input type="text" name="audience" class="form-control shadow-sm" placeholder="Students, Faculty, All">
            </div>

            {{-- Color --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    <i class="bi bi-palette me-1 text-secondary"></i> Color
                </label>
                <input type="color" name="color" class="form-control form-control-color shadow-sm" value="#007bff"
                    title="Choose event color">
            </div>

            {{-- Attachment --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    <i class="bi bi-paperclip me-1 text-secondary"></i> Attachment (Optional)
                </label>
                <input type="file" name="attachment" class="form-control shadow-sm">
                <div class="progress mt-2" style="display: none;" id="uploadProgress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar"
                        style="width: 0%;" id="uploadProgressBar">0%</div>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="text-end">
                <button type="submit" class="btn btn-lg btn-gradient btn-success shadow-sm px-4">
                    <i class="bi bi-check-circle me-2"></i> Save Event
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('eventForm');
            const submitBtn = form.querySelector('button[type="submit"]');

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Saving...
            `;
                setTimeout(() => form.submit(), 100);
            });
        });
    </script>
@endsection
