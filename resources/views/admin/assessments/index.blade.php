@extends('layouts.admin')

@section('title', 'Assessment List')
@section('breadcrumb-title', 'Academics')
@section('breadcrumb-link', route('admin.academics'))

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <style>
        .assessment-card {
            transition: transform 0.2s;
        }
        .assessment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .pdf-icon {
            font-size: 1.5rem;
            vertical-align: middle;
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary">
                <i class="fas fa-clipboard-check me-2"></i>Class Assessments (PDF)
            </h2>
            <a href="{{ route('admin.assessments.create') }}" class="btn btn-success">
                <i class="fas fa-plus-circle me-2"></i> Upload New Assessment
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($assessments->isEmpty())
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>No assessment PDFs found.
            </div>
        @else
            <div class="row">
                @foreach ($assessments as $assessment)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card assessment-card h-100 border-0 shadow-sm">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-graduation-cap text-primary me-2"></i>
                                       Class {{ $assessment->classname }}
                                    </h5>
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-file-pdf text-danger me-1"></i> PDF
                                    </span>
                                </div>

                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <a href="{{ $assessment->pdf_url }}" target="_blank" 
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-eye me-1"></i> View
                                        </a>
                                        <a href="{{ route('admin.assessments.download', $assessment->id) }}" 
                                           class="btn btn-outline-success btn-sm">
                                            <i class="fas fa-download me-1"></i> Download
                                        </a>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('admin.assessments.edit', $assessment->id) }}" 
                                           class="btn btn-sm btn-warning me-2">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.assessments.destroy', $assessment->id) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Delete this assessment PDF?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        // Auto-dismiss alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>
@endsection