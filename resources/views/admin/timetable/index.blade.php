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
            <h2 class="text-primary">All Class Timetables (PDF)</h2>
            <a href="{{ route('admin.timetables.create') }}" class="btn btn-success">
                <i class="fas fa-plus-circle me-2"></i> Add New Timetable
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($timetables->isEmpty())
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>No timetables found.
            </div>
        @else
            <div class="row">
                @foreach ($timetables as $timetable)
                    <div class="col-md-6">
                        <div class="card shadow-sm mb-4 border-0">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-school me-2 text-primary"></i>Class:
                                    <strong>{{ $timetable->classname }}</strong>
                                </h5>
                                <p>
                                    <i class="fas fa-file-pdf me-2 text-danger"></i>
                                    <a href="{{ $timetable->pdf_url }}" target="_blank" class="text-decoration-underline">
                                        View Timetable PDF
                                    </a>
                                </p>

                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('admin.timetables.edit', $timetable->id) }}"
                                        class="btn btn-warning btn-sm me-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.timetables.destroy', $timetable->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this timetable?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
