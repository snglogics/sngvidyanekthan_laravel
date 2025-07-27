@extends('layouts.admin')

@section('title', 'Add Assessment')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .input-group .remove-subject {
            white-space: nowrap;
        }
    </style>
@endsection

@section('content')

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.assessments.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Create Assessment
    </a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Date</th>
            <th>Type</th>
            <th>Class</th>
            <th>Marks</th>
            <th>Duration</th>
            <th>Open House</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($assessments as $a)
        <tr>
            <td>{{ \Carbon\Carbon::parse($a->assessment_date)->format('d M Y') }}</td>
            <td>{{ $a->assessment_type }}</td>
            <td>{{ $a->class }}</td>
            <td>{{ $a->marks }}</td>
            <td>{{ $a->duration }}</td>
            <td>{{ $a->open_house }}</td>
            <td>
                <a href="{{ route('admin.assessments.edit', $a->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.assessments.destroy', $a->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
