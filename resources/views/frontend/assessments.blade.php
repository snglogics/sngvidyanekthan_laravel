@extends('layouts.layout')

@section('title', 'Assessments')
@section('hero_title', 'Assessments')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .class-group {
            margin-bottom: 2rem;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
        }
        .class-header {
            background-color: #f8f9fa;
            padding: 0.75rem 1.25rem;
            border-bottom: 1px solid #dee2e6;
            font-weight: bold;
        }
        .assessment-month {
            font-weight: bold;
            background-color: #e9ecef;
            padding: 0.5rem 1.25rem;
            border-bottom: 1px solid #dee2e6;
        }
        .assessment-item {
            padding: 0.75rem 1.25rem;
            border-bottom: 1px solid #dee2e6;
        }
        .assessment-item:last-child {
            border-bottom: none;
        }
        .filter-container {
            background-color: #f8f9fa;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 0.25rem;
            border: 1px solid #dee2e6;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
       
    </div>
    <!-- Filter Section -->
    <div class="filter-container">
        <form method="GET" action="{{ route('frontend.assessments') }}" class="row g-3">
            <div class="col-md-4">
                <label for="class" class="form-label">Filter by Class</label>
                <select name="class" id="class" class="form-select">
                    <option value="">All Classes</option>
                    @foreach($classes as $class)
                        <option value="{{ $class }}" {{ request('class') == $class ? 'selected' : '' }}>{{ $class }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="bi bi-funnel"></i> Apply Filter
                </button>
                <a href="{{ route('frontend.assessments') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-counterclockwise"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Assessments Display -->
    @if($groupedAssessments->isEmpty())
        <div class="alert alert-info">No assessments found.</div>
    @else
        @foreach($groupedAssessments as $class => $months)
            <div class="class-group">
                <div class="class-header">
                    Class: {{ $class }}
                </div>
                
                @foreach($months as $month => $assessments)
                    <div class="assessment-month">
                        {{ $month }}
                    </div>
                    
                    @foreach($assessments as $assessment)
                        <div class="assessment-item">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <strong>Date:</strong> {{ \Carbon\Carbon::parse($assessment->assessment_date)->format('d M Y') }}
                                </div>
                                <div class="col-md-2">
                                    <strong>Type:</strong> {{ $assessment->assessment_type }}
                                </div>
                                <div class="col-md-2">
                                    <strong>Marks:</strong> {{ $assessment->marks ?? 'N/A' }}
                                </div>
                                <div class="col-md-2">
                                    <strong>Duration:</strong> {{ $assessment->duration ?? 'N/A' }}
                                </div>
                                <div class="col-md-2">
                                    <strong>Open House:</strong> {{ $assessment->open_house ?? 'N/A' }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        @endforeach
    @endif
</div>
@endsection