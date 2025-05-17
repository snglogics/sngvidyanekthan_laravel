@extends('layouts.layout')

@section('title', 'Academic Performance Details')

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
        overflow: hidden;
        position: relative;
    }

    .performance-details img {
        width: 100%;
        max-width: 400px;
        border-radius: 20px;
        margin-bottom: 20px;
        transition: all 0.3s ease-in-out;
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
        list-style-type: none;
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
    }

    .summary-box h3, .summary-box p {
        margin: 0;
        color: #ffffff;
        font-weight: bold;
    }

    .back-btn {
        background-color: #28a745;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
        display: inline-block;
    }

    .back-btn:hover {
        background-color: #218838;
        text-decoration: none;
    }

    .download-btn {
        background-color: #f39c12;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
        display: inline-block;
        margin-left: 15px;
    }

    .download-btn:hover {
        background-color: #e67e22;
        text-decoration: none;
    }
</style>
@endsection


@section('content')
<div class="container">
    <div class="performance-details" data-aos="fade-up">
        <!-- Image Section -->
        @if($academicPerformance->image_url)
            <img src="{{ $academicPerformance->image_url }}" alt="{{ $academicPerformance->student_name }}">
        @else
            <img src="https://via.placeholder.com/400" alt="No Image Available">
        @endif

        <!-- Details Section -->
        <h3><i class="fas fa-user-graduate"></i> {{ $academicPerformance->student_name }} - Performance Details</h3>
        
        <ul class="subject-list">
            @php
                $subjectsMarks = json_decode($academicPerformance->subjects_marks, true);
            @endphp

            @if(is_array($subjectsMarks))
                @foreach($subjectsMarks as $subject => $marks)
                    <li>
                        <i class="fas fa-book"></i> <strong>{{ $subject }}</strong>: {{ $marks }} marks
                    </li>
                @endforeach
            @else
                <li><i class="fas fa-exclamation-circle"></i> No subjects found.</li>
            @endif
        </ul>

        <div class="summary-box">
            <h3>Total Marks: {{ $academicPerformance->total_marks }}</h3>
            <p>Percentage: {{ $academicPerformance->percentage }}%</p>
            <p>Grade: {{ $academicPerformance->grade }}</p>
        </div>

        <a href="{{ route('frontend.academic_performances.index') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>

        <!-- <a href="#" class="download-btn">
            <i class="fas fa-file-download"></i> Download PDF
        </a> -->
    </div>
</div>
@endsection

