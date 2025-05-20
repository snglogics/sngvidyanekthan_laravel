@extends('layouts.admin')

@section('title', 'Academic Calendar Events')
@section('breadcrumb-title', 'Academics')
@section('breadcrumb-link', route('admin.academics'))


@section('styles')
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
@endsection
@section('content')

<a href="{{ route('admin.academic-calendars.create') }}" class="btn btn-primary mb-4">
    <i class="bi bi-plus-circle me-1"></i> Add New Event
</a>

<div class="card shadow border-0">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th><i class="bi bi-calendar-event me-1 text-primary"></i> Event Name</th>
                    <th><i class="bi bi-calendar-date me-1 text-success"></i> Start</th>
                    <th><i class="bi bi-calendar-check me-1 text-danger"></i> End</th>
                    <th><i class="bi bi-tags me-1 text-warning"></i> Type</th>
                    <th><i class="bi bi-journal-text me-1 text-info"></i> Academic Year</th>
                    <th><i class="bi bi-people-fill me-1 text-secondary"></i> Audience</th>
                    <th><i class="bi bi-gear-fill me-1 text-dark"></i> Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                <tr>
                    <td><strong>{{ $event->event_name }}</strong></td>
                    <td>{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}</td>
                    <td>{{ $event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('d M Y') : '—' }}</td>
                    <td><span class="badge bg-info text-dark">{{ $event->event_type }}</span></td>
                    <td><span class="badge bg-light border">{{ $event->academic_year }}</span></td>
                    <td>{{ $event->audience ?? '—' }}</td>
                    <td>
                        <a href="{{ route('admin.academic-calendars.edit', $event->id) }}" class="btn btn-sm btn-outline-warning" title="Edit Event">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('admin.academic-calendars.destroy', $event->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this event?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Event">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">
                        <i class="bi bi-info-circle me-1"></i> No events found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
