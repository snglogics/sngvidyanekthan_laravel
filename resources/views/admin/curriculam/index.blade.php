@extends('layouts.admin')

@section('title', 'Curriculum Management')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary"><i class="fas fa-book-open"></i> Curriculum Management</h2>
        <a href="{{ route('admin.curriculums.create') }}" class="btn btn-success"><i class="fas fa-plus-circle"></i> Add Curriculum</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($curriculums as $curriculum)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-body">
                    <h5 class="card-title text-primary"><i class="fas fa-chalkboard-teacher"></i> {{ $curriculum->subject }}</h5>
                    <p class="card-subtitle mb-2 text-muted"><i class="fas fa-users"></i> {{ $curriculum->class_group }} - {{ $curriculum->term }}</p>
                    <p class="card-text"><i class="fas fa-calendar-alt"></i> {{ $curriculum->academic_year }}</p>
                    <p class="card-text"><i class="fas fa-align-left"></i> {{ Str::limit($curriculum->description, 70) }}</p>

                    @if($curriculum->document_url)
                        <a href="{{ $curriculum->document_url }}" class="btn btn-outline-info btn-sm mb-2" target="_blank">
                            <i class="fas fa-file-pdf"></i> View Syllabus
                        </a>
                    @else
                        <span class="text-muted"><i class="fas fa-file-excel"></i> No file</span>
                    @endif

                    <div class="d-flex">
                        <a href="{{ route('admin.curriculums.edit', $curriculum->id) }}" class="btn btn-warning btn-sm me-2">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        <form action="{{ route('admin.curriculums.destroy', $curriculum->id) }}" method="POST" onsubmit="return confirm('Delete this curriculum?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
