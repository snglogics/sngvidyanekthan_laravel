

@extends('layouts.admin')

@section('title', 'Timetable List')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">All Timetables</h2>
    <a href="{{ route('admin.timetables.create') }}" class="btn btn-primary mb-3">Add New Timetable</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

   
        <tbody>
        @foreach($timetables as $group => $entries)
    <h4 class="text-primary mt-4">{{ $group }}</h4>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Day</th>
                <th>Period</th>
                <th>Subject</th>
                <th>Teacher</th>
                <th>Start</th>
                <th>End</th>
                <th>Room</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entries as $entry)
            <tr>
                <td>{{ $entry->day }}</td>
                <td>{{ $entry->period_number }}</td>
                <td>{{ $entry->subject }}</td>
                <td>{{ $entry->teacher_name }}</td>
                <td>{{ \Carbon\Carbon::parse($entry->start_time)->format('h:i A') }}</td>
                <td>{{ \Carbon\Carbon::parse($entry->end_time)->format('h:i A') }}</td>
                <td>{{ $entry->room_number }}</td>
                <td>
                    <a href="{{ route('admin.timetables.edit', $entry->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.timetables.destroy', $entry->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Delete this?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endforeach
       
</div>
@endsection
