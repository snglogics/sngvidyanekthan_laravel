@extends('layouts.admin')

@section('title', 'Syllabus List')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Syllabus List</h2>
    <a href="{{ route('admin.syllabuses.create') }}" class="btn btn-primary mb-3">Add New Syllabus</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($syllabuses->isEmpty())
        <p class="text-center">No syllabus available.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Class</th>
                    <th>Subject</th>
                    <th>Section</th>
                    <th>Year</th>
                    <th>Description</th>
                    <th>PDF</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($syllabuses as $syllabus)
                    <tr>
                        <td>{{ $syllabus->classname }}</td>
                        <td>{{ $syllabus->subject }}</td>
                        <td>{{ $syllabus->section }}</td>
                        <td>{{ $syllabus->academic_year }}</td>
                        <td>{{ $syllabus->description }}</td>
                        <td>
                            @if($syllabus->pdf_url)
                                <a href="{{ $syllabus->pdf_url }}" target="_blank" class="btn btn-sm btn-outline-secondary">View</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.syllabuses.edit', $syllabus->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.syllabuses.destroy', $syllabus->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
