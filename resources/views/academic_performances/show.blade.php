@extends('layouts.layout')

@section('title', 'Academic Performance Details')

@section('styles')
    <style>
        .performance-details {
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            padding: 30px;
            margin-bottom: 30px;
        }

        .performance-details img {
            width: 100%;
            max-width: 400px;
            border-radius: 20px;
            margin: 0 auto 20px;
            display: block;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .performance-details img:hover {
            transform: scale(1.05);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .performance-details h3 {
            color: #007bff;
            margin-bottom: 20px;
            text-align: center;
        }

        .subject-list {
            list-style: none;
            padding: 0;
            margin-bottom: 20px;
        }

        .subject-list li {
            background-color: #f8f9fa;
            border-radius: 10px;
            margin-bottom: 10px;
            padding: 15px 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
        }

        .subject-list li i {
            color: #007bff;
            margin-right: 10px;
            font-size: 20px;
        }

        .summary-box {
            background-color: #007bff;
            color: #fff;
            padding: 15px 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .summary-box h3,
        .summary-box p {
            margin: 0;
            font-weight: bold;
            color: #fff;
            position: relative;
            z-index: 1;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .back-btn {
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            color: #fff;
            background-color: #28a745;
            display: inline-flex;
            align-items: center;
            transition: background-color 0.3s ease-in-out;
        }

        .back-btn:hover {
            background-color: #218838;
        }

        .back-btn i {
            margin-right: 8px;
        }
    </style>
@endsection

@section('hero_title', 'Academic Performances')

@section('content')
    <div class="container">
        <div class="performance-details" data-aos="fade-up">

            {{-- Image --}}
            <img src="{{ $academicPerformance->image_url ?? 'https://via.placeholder.com/400' }}"
                alt="{{ $academicPerformance->student_name }}">

            {{-- Title --}}
            <h3><i class="fas fa-user-graduate"></i> {{ $academicPerformance->student_name }} - Performance Details</h3>

            {{-- Subject List --}}
            @php
                $subjectsMarks = json_decode($academicPerformance->subjects_marks, true);
            @endphp



            {{-- Summary --}}
            <div class="summary-box">
                {{-- <h3>Total Marks: {{ $academicPerformance->total_marks }}</h3> --}}
                <h3>Percentage: {{ number_format($academicPerformance->percentage, 2) }}%</h3>
            </div>

            {{-- Extra Info --}}
            <p class="text-center"><strong>Class:</strong> {{ $academicPerformance->class }} |
                <strong>Term:</strong> {{ $academicPerformance->term }} |
                <strong>Year:</strong> {{ $academicPerformance->year }}
            </p>

            @if ($academicPerformance->performance_description)
                <p class="text-center"><strong></strong> {{ $academicPerformance->performance_description }}
                </p>
            @endif

            {{-- Actions --}}
            <div class="action-buttons">
                <a href="{{ route('frontend.academic_performances.index') }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>
@endsection
