@extends('layouts.admin')

@section('title', 'View Timetable')
@section('breadcrumb-title', 'Timetable')
@section('breadcrumb-link', route('admin.timetables.index'))

@section('content')
    <div class="card p-4">
        <h2 class="text-center text-primary mb-4">Timetable Details</h2>

        <div class="mb-3">
            <strong>Class Name:</strong>
            <p>{{ $timetable->classname }}</p>
        </div>

        <div class="mb-3">
            <strong>Uploaded At:</strong>
            <p>{{ $timetable->created_at->format('d M Y, h:i A') }}</p>
        </div>

        <div class="mb-4">
            <strong>PDF Preview:</strong>
            <iframe src="https://docs.google.com/gview?url={{ urlencode($timetable->pdf_url) }}&embedded=true" width="100%"
                height="600px" frameborder="0"></iframe>
        </div>

        <a href="{{ route('admin.timetables.index') }}" class="btn btn-secondary">← Back to List</a>
    </div>
@endsection
