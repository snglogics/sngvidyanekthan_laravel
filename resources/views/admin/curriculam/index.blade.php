@extends('layouts.admin')

@section('title', 'Curriculum Management')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Curriculum List</h2>
        <a href="{{ route('admin.curriculums.create') }}" class="btn btn-sm btn-success">+ Add Curriculum</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Class Group</th>
                <th>Subject</th>
                <th>Overview</th>
                <th>Syllabus</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($curriculums as $curriculum)
            <tr>
                <td>{{ $curriculum->class_group }}</td>
                <td>{{ $curriculum->subject }}</td>
                <td>{{ Str::limit($curriculum->overview, 50) }}</td>
                <td><a href="{{ $curriculum->syllabus_pdf_url }}" target="_blank">View PDF</a></td>
                <td>
                    <a href="{{ route('admin.curriculums.edit', $curriculum->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.curriculums.destroy', $curriculum->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete curriculum?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
