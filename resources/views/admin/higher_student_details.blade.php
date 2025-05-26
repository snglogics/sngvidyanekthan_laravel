@extends('layouts.admin')

@section('title', 'Student Admission Details')

@section('styles')
<style>
    @media print {
        @page {
            size: A4;
            margin: 0.5cm;
        }

        body * {
            visibility: hidden;
        }

        #printSection, #printSection * {
            visibility: visible;
        }

        #printSection {
            position: absolute;
            top: 0;
            left: 0;
            padding: 10px;
            width: 100%;
            font-size: 11px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0;
        }

        .field-block {
            width: 32%;
            margin-right: 1%;
            margin-bottom: 8px;
        }

        .field-label {
            font-weight: bold;
            display: block;
        }

        .field-value {
            border-bottom: 1px solid #000;
            padding: 2px 0;
            min-height: 18px;
        }

        .btn, .card-header {
            display: none !important;
        }
    }
</style>
@endsection

@section('content')
<div class=" py-5" id="printSection">
    <div class="card shadow-lg p-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary mb-1">SREENARAYANA VIDYANIKETAN</h2>
            <h4 class="text-uppercase">Student Admission Details</h4>
        </div>

        {{-- Student Photo --}}
        <div class="text-center mb-4">
            <img src="{{ $student->photo_url }}" alt="Student Photo" style="width: 120px; height: 140px; object-fit: cover; border: 2px solid #000;">
        </div>

        {{-- Student Details --}}
        <div class="row ">
            <div class="field-block">
                <label class="field-label"><strong>Candidate's Name</strong></label>
                <div class="field-value">{{ $student->candidate_name }}</div>
            </div>
            <div class="field-block">
                <label class="field-label"><strong>Reg. No & Roll No</strong></label>
                <div class="field-value">{{ $student->reg_roll_no }}</div>
            </div>
            <div class="field-block">
                <label class="field-label"><strong>Year of Passing</strong></label>
                <div class="field-value">{{ $student->year_of_passing }}</div>
            </div>
            <div class="field-block">
                <label class="field-label"><strong>Board Type</strong></label>
                <div class="field-value">{{ $student->board_type }}</div>
            </div>
            <div class="field-block">
                <label class="field-label"><strong>Sex</strong></label>
                <div class="field-value">{{ $student->sex }}</div>
            </div>
            <div class="field-block">
                <label class="field-label"><strong>Date of Birth</strong></label>
                <div class="field-value">{{ $student->date_of_birth }}</div>
            </div>
            <div class="field-block">
                <label class="field-label"><strong>Annual Income</strong></label>
                <div class="field-value">{{ $student->annual_income }}</div>
            </div>
            <div class="field-block">
                <label class="field-label"><strong>Nationality</strong></label>
                <div class="field-value">{{ $student->nationality }}</div>
            </div>
            <div class="field-block">
                <label class="field-label"><strong>Religion & Caste</strong></label>
                <div class="field-value">{{ $student->religion_caste }}</div>
            </div>
            <div class="field-block">
                <label class="field-label"><strong>Category</strong></label>
                <div class="field-value">{{ $student->category }}</div>
            </div>
            <div class="field-block">
                <label class="field-label"><strong>Father's Name</strong></label>
                <div class="field-value">{{ $student->father_name }}</div>
            </div>
            <div class="field-block">
                <label class="field-label"><strong>Father's Occupation</strong></label>
                <div class="field-value">{{ $student->father_occupation }}</div>
            </div>
            <div class="field-block">
                <label class="field-label"><strong>Mother's Name</strong></label>
                <div class="field-value">{{ $student->mother_name }}</div>
            </div>
            <div class="field-block">
                <label class="field-label"><strong>Mother's Occupation</strong></label>
                <div class="field-value">{{ $student->mother_occupation }}</div>
            </div>
            <div class="field-block">
                <label class="field-label"><strong>Father's Educational Background</strong></label>
                <div class="field-value">{{ $student->father_education }}</div>
            </div>
            <div class="field-block">
                <label class="field-label"><strong>Mother's Educational Background</strong></label>
                <div class="field-value">{{ $student->mother_education }}</div>
            </div>
            <div class="field-block">
                <label class="field-label"><strong>Phone No</strong></label>
                <div class="field-value">{{ $student->phone_no }}</div>
            </div>
            <div class="field-block">
                <label class="field-label"><strong>Email</strong></label>
                <div class="field-value">{{ $student->email }}</div>
            </div>
            <div class="col-md-12">
                <label class="field-label"><strong>Address</strong></label>
                <div class="field-value">{{ $student->address }}</div>
            </div>
            <div class="col-md-12">
                <label class="field-label"><strong>Names & Classes of Siblings Already in the School</strong></label>
                <div class="field-value">{{ $student->siblings }}</div>
            </div>
            <div class="col-md-12">
                <label class="field-label"><strong>Name of Local Guardian with Phone Number</strong></label>
                <div class="field-value">{{ $student->local_guardian }}</div>
            </div>
            <div class="col-md-12">
                <label class="field-label"><strong>Hobbies</strong></label>
                <div class="field-value">{{ $student->hobbies }}</div>
            </div>
            <div class="col-md-12">
                <label class="field-label"><strong>Major Games and Track Events</strong></label>
                <div class="field-value">{{ $student->major_games }}</div>
            </div>
            <div class="col-md-12">
                <label class="field-label"><strong>Co-curricular Achievements (District/State Level)</strong></label>
                <div class="field-value">{{ $student->co_curricular_achievements }}</div>
            </div>

            {{-- Marks Table --}}
           {{-- Marks Table --}}
<div class="col-md-12 mt-4">
    {{-- Pre-Board Exams Table --}}
    <h5>Marks Scored in Qualifying Pre-Board Exams</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>SI.No.</th>
                <th>Subjects</th>
                <th>Percentage of Marks</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            @php $si = 1; @endphp
            @foreach(array_slice($student->subjects ?? [], 0, 6) as $index => $subject)
                @if(!empty($subject))
                    <tr>
                        <td>{{ $si++ }}</td>
                        <td>{{ $subject }}</td>
                        <td>{{ $student->percentages[$index] ?? '' }}</td>
                        <td>{{ $student->grades[$index] ?? '' }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

<div class="col-md-12 mt-4">
    {{-- Board Exams Table --}}
    <h5>Marks Scored in Qualifying Board Exams</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>SI.No.</th>
                <th>Subjects</th>
                <th>Percentage of Marks</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            @php $si = 1; @endphp
            @foreach(array_slice($student->subjects ?? [], 6) as $index => $subject)
                @php $realIndex = $index + 6; @endphp
                @if(!empty($subject))
                    <tr>
                        <td>{{ $si++ }}</td>
                        <td>{{ $subject }}</td>
                        <td>{{ $student->percentages[$realIndex] ?? '' }}</td>
                        <td>{{ $student->grades[$realIndex] ?? '' }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

        </div>

        {{-- Print Button --}}
        <div class="text-center mt-4">
            <button class="btn btn-primary" onclick="window.print()">Print Details</button>
        </div>
    </div>
</div>
@endsection
