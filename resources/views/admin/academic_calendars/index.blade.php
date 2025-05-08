@extends('layouts.admin')

@section('title', 'Academic Calendar Events')

@section('content')
<a href="{{ route('admin.academic-calendars.create') }}" class="btn btn-primary mb-3">Add New Event</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Event Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Type</th>
            <th>Academic Year</th>
            <th>Audience</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($events as $event)
        <tr>
            <td>{{ $event->event_name }}</td>
            <td>{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}</td>
            <td>{{ $event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('d M Y') : 'N/A' }}</td>
            <td>{{ $event->event_type }}</td>
            <td>{{ $event->academic_year }}</td>
            <td>{{ $event->audience }}</td>
            <td>
              
                <a href="{{ route('admin.academic-calendars.edit', $event->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.academic-calendars.destroy', $event->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
