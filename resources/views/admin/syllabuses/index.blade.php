@extends('layouts.admin')

@section('title', 'Syllabus List')
@section('breadcrumb-title', 'Academics')
@section('breadcrumb-link', route('admin.academics'))

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary"><i class="fas fa-book-open me-2"></i>Syllabus List</h2>
        <a href="{{ route('admin.syllabuses.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-1"></i>Add New Syllabus
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($syllabuses->isEmpty())
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle me-2"></i>No syllabus available.
        </div>
    @else
        <div class="card shadow-lg rounded-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary text-center">
                        <tr>
                            <th><i class="fas fa-school me-1"></i>Class</th>
                            <th><i class="fas fa-book me-1"></i>Subject</th>
                            <th><i class="fas fa-layer-group me-1"></i>Section</th>
                            <th><i class="fas fa-calendar-alt me-1"></i>Year</th>
                            <th><i class="fas fa-align-left me-1"></i>Description</th>
                            <th><i class="fas fa-file-pdf me-1"></i>PDF</th>
                            <th><i class="fas fa-cogs me-1"></i>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($syllabuses as $syllabus)
                            <tr class="text-center">
                                <td>{{ $syllabus->classname }}</td>
                                <td>{{ $syllabus->subject }}</td>
                                <td>{{ $syllabus->section }}</td>
                                <td>{{ $syllabus->academic_year }}</td>
                                <td class="text-start">{{ Str::limit($syllabus->description, 50) }}</td>
                                <td>
                                    @if($syllabus->pdf_url)
                                        <a href="{{ $syllabus->pdf_url }}" target="_blank" class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.syllabuses.edit', $syllabus->id) }}" class="btn btn-sm btn-warning me-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.syllabuses.destroy', $syllabus->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
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
    @endif
</div>
@endsection
