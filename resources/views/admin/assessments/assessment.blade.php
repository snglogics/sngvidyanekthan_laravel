@extends('layouts.layout')

@section('title', 'Class Assessments')
@section('hero_title', 'Exam Assessments')

@section('styles')
    <style>
        .assessment-header {
            cursor: pointer;
            background-color: rgba(13, 110, 253, 0.1);
            padding: 1.25rem;
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
            margin-bottom: 0.5rem;
        }
        .assessment-header:hover {
            background-color: rgba(13, 110, 253, 0.15);
        }
        .assessment-content {
            padding: 1.5rem;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-top: none;
            border-radius: 0 0 0.5rem 0.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
        }
        .assessment-viewer {
            width: 100%;
            height: 700px;
            border: 1px solid #eee;
            border-radius: 0.5rem;
            background-color: #f8f9fa;
        }
        .action-buttons {
            margin-top: 1rem;
            display: flex;
            gap: 0.75rem;
        }
        .no-assessments {
            text-align: center;
            padding: 2rem;
            background-color: #f8f9fa;
            border-radius: 0.5rem;
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
           
            <p class="lead">download assessment schedules for all classes</p>
        </div>

        @if ($assessments->isEmpty())
            <div class="no-assessments">
                <i class="fas fa-file-pdf fa-4x text-muted mb-3"></i>
                <h4>No assessments available</h4>
                <p class="text-muted">Check back later or contact the administration</p>
            </div>
        @else
            @foreach ($assessments as $assessment)
                @php
                    $id = 'assessment_' . preg_replace('/\s+/', '_', strtolower($assessment->classname));
                    $pdfUrl = $assessment->pdf_url . '#toolbar=0&navpanes=0';
                @endphp

                <div class="assessment-container mb-4">
                    <div class="assessment-header" onclick="toggleAssessment('{{ $id }}')">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-graduation-cap text-primary me-3"></i>
                            <h5 class="mb-0">{{ $assessment->classname }}</h5>
                        </div>
                        <i class="fas fa-chevron-down toggle-icon" id="icon-{{ $id }}"></i>
                    </div>

                    <div class="assessment-content" id="{{ $id }}" style="display: none;">
                        <div class="assessment-viewer-container">
                            <iframe src="https://docs.google.com/gview?url={{ urlencode($assessment->pdf_url) }}&embedded=true" 
                                    class="assessment-viewer"
                                    allowfullscreen></iframe>
                        </div>
                        
                        <div class="action-buttons">
                            <a href="{{ route('admin.assessments.download', $assessment->id) }}" 
                               class="btn btn-primary">
                                <i class="fas fa-download me-2"></i>Download PDF
                            </a>
                           
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        function toggleAssessment(id) {
            const content = document.getElementById(id);
            const icon = document.getElementById("icon-" + id);
            const isVisible = content.style.display === "block";
            
            content.style.display = isVisible ? "none" : "block";
            icon.classList.toggle("fa-chevron-down", isVisible);
            icon.classList.toggle("fa-chevron-up", !isVisible);
            
            // Smooth scroll to the content if opening
            if (!isVisible) {
                setTimeout(() => {
                    content.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }, 100);
            }
        }

        // Open first assessment by default
        document.addEventListener('DOMContentLoaded', function() {
            @if(!$assessments->isEmpty())
                toggleAssessment('assessment_{{ preg_replace('/\s+/', '_', strtolower($assessments[0]->classname)) }}');
            @endif
        });
    </script>
@endsection