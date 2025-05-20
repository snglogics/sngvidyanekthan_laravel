@extends('layouts.admin')

@section('title', 'Timetable List')
@section('breadcrumb-title', 'Academics')
@section('breadcrumb-link', route('admin.academics'))

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">All Timetables</h2>
        <a href="{{ route('admin.timetables.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle me-2"></i>Add New Timetable
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @forelse($timetables as $group => $entries)
    <div class="card shadow-sm mb-4 border-left-primary">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-chalkboard-teacher me-2"></i>Class: {{ $group }}</h5>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Day</th>
                            <th>Period</th>
                            <th>Subject</th>
                            <th>Teacher</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Room</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($entries as $entry)
                        <tr>
                            <td><span class="badge bg-info">{{ $entry->day }}</span></td>
                            <td>{{ $entry->period_number }}</td>
                            <td>{{ $entry->subject }}</td>
                            <td>{{ $entry->teacher_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($entry->start_time)->format('h:i A') }}</td>
                            <td>{{ \Carbon\Carbon::parse($entry->end_time)->format('h:i A') }}</td>
                            <td>{{ $entry->room_number }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.timetables.edit', $entry->id) }}" class="btn btn-sm btn-warning me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.timetables.destroy', $entry->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure you want to delete this entry?')" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @empty
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>No timetables found.
        </div>
    @endforelse
</div>
@endsection
