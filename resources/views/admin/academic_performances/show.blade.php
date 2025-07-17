@extends('layouts.admin')

@section('title', 'Academic Performance Details')
@section('breadcrumb-title', 'Achievements')
@section('breadcrumb-link', route('admin.achievements'))
@section('styles')
    <style>
        .performance-details {
            background-color: #f8f9fa;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }

        .performance-details img {
            width: 100%;
            max-width: 300px;
            height: auto;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        .subject-list {
            list-style-type: none;
            padding: 0;
        }

        .subject-list li {
            background-color: #ffffff;
            border-radius: 10px;
            margin-bottom: 10px;
            padding: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            font-weight: 500;
        }

        .summary-box {
            background-color: #007bff;
            color: #fff;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
        }

        .summary-box h3,
        .summary-box p {
            margin: 0;
            color: #ffffff;
        }

        .back-btn {
            background-color: #28a745;
            border-color: #28a745;
            color: #fff;
            transition: all 0.3s ease-in-out;
            margin-top: 15px;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
            display: block;
            font-weight: 600;
            text-decoration: none;
        }

        .back-btn:hover {
            background-color: #218838;
            border-color: #218838;
        }

        .performance-meta {
            margin-bottom: 20px;
            font-weight: 500;
        }

        .performance-meta strong {
            display: inline-block;
            width: 150px;
        }

        .no-image {
            background-color: #ddd;
            width: 100%;
            max-width: 300px;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            font-weight: 600;
            color: #555;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="performance-details">
            @if ($academicPerformance->image_url)
                <img src="{{ $academicPerformance->image_url }}" alt="{{ $academicPerformance->student_name }}">
            @else
                <div class="no-image">
                    No Image Available
                </div>
            @endif

            <h3>{{ $academicPerformance->student_name }} - Performance Details</h3>

            <div class="performance-meta">
                {{-- <p><strong>Roll Number:</strong> {{ $academicPerformance->roll_number }}</p> --}}
                <p><strong>Class:</strong> {{ $academicPerformance->class }}</p>
                {{-- <p><strong>Section:</strong> {{ $academicPerformance->section ?? 'N/A' }}</p> --}}

                <p><strong>Term:</strong> {{ $academicPerformance->term }}</p>
                <p><strong>Year:</strong> {{ $academicPerformance->year }}</p>
                <p><strong>Performance Description:</strong>
                    {{ $academicPerformance->performance_description ?? 'No Description' }}</p>
            </div>

            @php
                $subjectsMarks = json_decode($academicPerformance->subjects_marks, true);
            @endphp

            @if ($subjectsMarks && is_array($subjectsMarks))
            @else
                <p>No subjects found.</p>
            @endif

            <div class="summary-box">
                {{-- <h3>Total Marks: {{ $academicPerformance->total_marks }}</h3> --}}
                <p>Percentage: {{ $academicPerformance->percentage }}%</p>
                {{-- <p>Grade: {{ $academicPerformance->grade }}</p> --}}
            </div>

            <a href="{{ route('admin.academic_performances.index') }}" class="back-btn">Back to List</a>
        </div>
    </div>
@endsection
