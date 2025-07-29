@extends('layouts.admin')

@section('title', 'View Assessment')
@section('breadcrumb-title', 'Assessments')
@section('breadcrumb-link', route('admin.assessments.index'))

@section('styles')
    <style>
        .assessment-card {
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .assessment-header {
            background-color: #0d6efd;
            color: white;
            padding: 1.5rem;
            text-align: center;
        }
        .assessment-body {
            padding: 2rem;
        }
        .assessment-detail {
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #eee;
        }
        .assessment-detail:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .pdf-viewer-container {
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            overflow: hidden;
            margin: 1.5rem 0;
        }
        .pdf-viewer {
            width: 100%;
            height: 600px;
            border: none;
        }
        .action-btn {
            min-width: 150px;
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        <div class="assessment-card">
            <div class="assessment-header">
                <h2 class="mb-0">
                    <i class="fas fa-clipboard-check me-2"></i>Assessment Details
                </h2>
            </div>

            <div class="assessment-body">
                <div class="assessment-detail">
                    <h5 class="text-primary">
                        <i class="fas fa-graduation-cap me-2"></i>Class Information
                    </h5>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <strong>Class Name:</strong>
                            <p class="fs-5">{{ $assessment->classname }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Uploaded On:</strong>
                            <p class="fs-5">{{ $assessment->created_at->format('F j, Y \a\t g:i A') }}</p>
                        </div>
                    </div>
                </div>

                <div class="assessment-detail">
                    <h5 class="text-primary">
                        <i class="fas fa-file-pdf me-2"></i>Assessment Document
                    </h5>
                    <div class="pdf-viewer-container mt-3">
                        <iframe src="https://docs.google.com/gview?url={{ urlencode($assessment->pdf_url) }}&embedded=true" 
                                class="pdf-viewer"
                                allowfullscreen></iframe>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.assessments.index') }}" class="btn btn-outline-secondary action-btn">
                        <i class="fas fa-arrow-left me-2"></i>Back to List
                    </a>
                    <div class="d-flex gap-3">
                        <a href="{{ route('admin.assessments.download', $assessment->id) }}" 
                           class="btn btn-primary action-btn">
                            <i class="fas fa-download me-2"></i>Download PDF
                        </a>
                        <a href="{{ route('admin.assessments.edit', $assessment->id) }}" 
                           class="btn btn-warning action-btn">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection