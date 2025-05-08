@extends('layouts.layout')

@section('title', 'Academic Calendar')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.7/main.min.css" />
<style>
    .fc .fc-toolbar-title {
        font-weight: bold;
        color: #007bff;
    }
    .fc-daygrid-event {
        background-color: #007bff !important;
        border: none;
        color: #fff !important;
        font-weight: 500;
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <h2 class="text-center text-primary mb-4">Academic Calendar</h2>

    <div class="row mb-4">
        <div class="col-md-6">
            <label>Filter by Academic Year</label>
            <select id="academicYearFilter" class="form-control">
                <option value="all">All</option>
                @foreach($academicYears as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label>Filter by Month</label>
            <select id="monthFilter" class="form-control">
                <option value="all">All</option>
                @foreach(range(1, 12) as $month)
                    <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div id="calendar"></div>
</div>

<!-- Modal for Event Details -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Event Name:</strong> <span id="eventName"></span></p>
                <p><strong>Start Date:</strong> <span id="eventStart"></span></p>
                <p><strong>End Date:</strong> <span id="eventEnd"></span></p>
                <p><strong>Audience:</strong> <span id="eventAudience"></span></p>
                <p><strong>Description:</strong> <span id="eventDescription"></span></p>
                <a href="#" target="_blank" id="eventAttachment" class="btn btn-primary">View Attachment</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.7/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.7/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.7/main.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: "{{ route('academic-calendars.events') }}",
        dateClick: function(info) {
            console.log(info.dateStr);
        },
        eventClick: function(info) {
            const event = info.event.extendedProps;
            document.getElementById('eventName').textContent = event.event_name;
            document.getElementById('eventStart').textContent = event.start_date;
            document.getElementById('eventEnd').textContent = event.end_date || 'N/A';
            document.getElementById('eventAudience').textContent = event.audience || 'N/A';
            document.getElementById('eventDescription').textContent = event.description || 'No description';
            document.getElementById('eventAttachment').href = event.attachment_url || '#';
            document.getElementById('eventAttachment').style.display = event.attachment_url ? 'inline-block' : 'none';
            new bootstrap.Modal(document.getElementById('eventModal')).show();
        }
    });
    calendar.render();

    // Filter by Academic Year and Month
    const academicYearFilter = document.getElementById('academicYearFilter');
    const monthFilter = document.getElementById('monthFilter');
    
    academicYearFilter.addEventListener('change', function() {
        calendar.refetchEvents();
    });
    
    monthFilter.addEventListener('change', function() {
        calendar.refetchEvents();
    });
});
</script>
@endsection
