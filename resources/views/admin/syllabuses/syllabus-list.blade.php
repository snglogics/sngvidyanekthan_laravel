@extends('layouts.layout')

@section('title', 'Syllabus List')
@section('hero_title', 'Explore Our Syllabuses')

@section('content')
<div class="container py-5">

    @if($syllabuses->isEmpty())
        <div class="text-center text-muted fs-5">
            <i class="bi bi-exclamation-circle me-2"></i> No syllabus available at the moment.
        </div>
    @else
        <div class="row g-4">
            @foreach($syllabuses as $syllabus)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm h-100 border-0">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title text-primary fw-bold">
                                    <i class="bi bi-journal-bookmark-fill me-1"></i>
                                   Class: {{ $syllabus->classname }} - {{ $syllabus->subject }}
                                </h5>
                                <p class="card-text text-muted small">
                                    <i class="bi bi-info-circle me-1"></i>
                                    {{ $syllabus->description ?? 'No description provided for this syllabus.' }}
                                </p>
                                <p class="card-text mb-2">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    <strong>Academic Year:</strong> {{ $syllabus->academic_year }}
                                </p>
                            </div>

                            @if($syllabus->pdf_url)
                                <a href="{{ $syllabus->pdf_url }}" target="_blank" class="btn btn-outline-primary btn-sm mt-3 w-100">
                                    <i class="bi bi-file-earmark-pdf me-1"></i> View Syllabus PDF
                                </a>
                            @else
                                <p class="text-muted mt-3 small"><i class="bi bi-file-earmark-x me-1"></i> PDF not available.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection

@section('scripts')
<!-- Bootstrap Icons if not already in your layout -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endsection
