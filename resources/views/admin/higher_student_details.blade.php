@extends('layouts.admin')

@section('title', 'Student Admission Details')

@section('styles')
<style>
    @media print {
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
            margin: 0;
            padding: 20px;
            width: 100%;
        }
        .card {
            box-shadow: none !important;
            border: 1px solid #000 !important;
        }
        .btn {
            display: none !important;
        }
    }
</style>
@endsection

@section('content')
<div class="container py-5" id="printSection">
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
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label"><strong>Candidate's Name</strong></label>
                <div class="form-control">{{ $student->candidate_name }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label"><strong>Reg. No & Roll No</strong></label>
                <div class="form-control">{{ $student->reg_roll_no }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label"><strong>Year of Passing</strong></label>
                <div class="form-control">{{ $student->year_of_passing }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label"><strong>Board Type</strong></label>
                <div class="form-control">{{ $student->board_type }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label"><strong>Sex</strong></label>
                <div class="form-control">{{ $student->sex }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label"><strong>Date of Birth</strong></label>
                <div class="form-control">{{ $student->date_of_birth }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label"><strong>Annual Income</strong></label>
                <div class="form-control">{{ $student->annual_income }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label"><strong>Nationality</strong></label>
                <div class="form-control">{{ $student->nationality }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label"><strong>Religion & Caste</strong></label>
                <div class="form-control">{{ $student->religion_caste }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label"><strong>Category</strong></label>
                <div class="form-control">{{ $student->category }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label"><strong>Father's Name</strong></label>
                <div class="form-control">{{ $student->father_name }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label"><strong>Father's Occupation</strong></label>
                <div class="form-control">{{ $student->father_occupation }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label"><strong>Mother's Name</strong></label>
                <div class="form-control">{{ $student->mother_name }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label"><strong>Mother's Occupation</strong></label>
                <div class="form-control">{{ $student->mother_occupation }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label"><strong>Father's Educational Background</strong></label>
                <div class="form-control">{{ $student->father_education }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label"><strong>Mother's Educational Background</strong></label>
                <div class="form-control">{{ $student->mother_education }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label"><strong>Phone No</strong></label>
                <div class="form-control">{{ $student->phone_no }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label"><strong>Email</strong></label>
                <div class="form-control">{{ $student->email }}</div>
            </div>
            <div class="col-md-12">
                <label class="form-label"><strong>Address</strong></label>
                <div class="form-control">{{ $student->address }}</div>
            </div>
            <div class="col-md-12">
                <label class="form-label"><strong>Names & Classes of Siblings Already in the School</strong></label>
                <div class="form-control">{{ $student->siblings }}</div>
            </div>
            <div class="col-md-12">
                <label class="form-label"><strong>Name of Local Guardian with Phone Number</strong></label>
                <div class="form-control">{{ $student->local_guardian }}</div>
            </div>
            <div class="col-md-12">
                <label class="form-label"><strong>Hobbies</strong></label>
                <div class="form-control">{{ $student->hobbies }}</div>
            </div>
            <div class="col-md-12">
                <label class="form-label"><strong>Major Games and Track Events</strong></label>
                <div class="form-control">{{ $student->major_games }}</div>
            </div>
            <div class="col-md-12">
                <label class="form-label"><strong>Co-curricular Achievements (District/State Level)</strong></label>
                <div class="form-control">{{ $student->co_curricular_achievements }}</div>
            </div>

            {{-- Marks Table --}}
            <div class="col-md-12 mt-4">
                <h5>Marks Scored in Qualifying Exams</h5>
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
                        @foreach($student->subjects ?? [] as $index => $subject)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $subject }}</td>
                            <td>{{ $student->percentages[$index] ?? '' }}</td>
                            <td>{{ $student->grades[$index] ?? '' }}</td>
                        </tr>
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
