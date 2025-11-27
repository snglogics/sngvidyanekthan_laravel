@extends('layouts.admin')

@section('title', 'Senior Student Admission Details')

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

            #printSection,
            #printSection * {
                visibility: visible;
            }

            #printSection {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                padding: 8px;
                font-size: 10px;
            }

            .row {
                display: flex;
                flex-wrap: wrap;
                margin: 0;
            }

            .field-block {
                width: 32%;
                margin-right: 1%;
                margin-bottom: 6px;
            }

            .field-label {
                font-weight: bold;
                display: block;
                margin-bottom: 2px;
            }

            .field-value {
                border-bottom: 1px solid #000;
                padding: 2px 0;
                min-height: 18px;
            }

            .btn,
            .card-header {
                display: none !important;
            }

            table {
                width: 100% !important;
                font-size: 10px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="py-5" id="printSection">
        <div class="card shadow-lg p-5">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-primary">Sivagiri
                    Vidya Niketan</h2>
                <h4 class="text-uppercase">Senior Student Admission Details</h4>
            </div>

            {{-- Photo --}}
            <div class="text-center mb-4">
                <img src="{{ $student->photo_url }}" alt="Photo"
                    style="width:120px; height:140px; object-fit:cover; border:2px solid #000;">
            </div>

            <div class="row">
                @php
                    $fields = [
                        'Admission Class' => $student->admission_class,
                        'Student Name' => $student->pupil_name,
                        'Gender' => $student->gender,
                        'Date of Birth' => $student->date_of_birth,
                        'Aadhaar No' => $student->aadhaar_no,
                        'Father Name' => $student->father_name,
                        'Father Occupation' => $student->father_occupation,
                        'Mother Name' => $student->mother_name,
                        'Mother Occupation' => $student->mother_occupation,
                        'Address' => $student->address,
                        'Phone Number' => $student->phone_number,
                        'WhatsApp Number' => $student->whatsapp_number,
                        'Email' => $student->email,
                        'Annual Income' => $student->annual_income,
                        'Nationality' => $student->nationality,
                        'Religion & Caste' => $student->religion_caste,
                        'Last Institution Attended' => $student->last_institution_attended,
                        'Medium of Instruction' => $student->medium_of_instruction,
                        'Mother Tongue' => $student->mother_tongue,
                        'Parent Education' => $student->parent_education,
                        'Family Members' => $student->family_members,
                        'Siblings' => $student->siblings,
                        'Immunization Status' => $student->immunization_status,
                        'Local Guardian' => $student->local_guardian,
                        'Hobbies' => $student->hobbies,
                        'Games Played' => $student->games_played,
                        'Co-curricular Achievements' => $student->cocurricular_achievements,
                        'CCA Options' => $student->cca_options,
                        'Year of Passing' => $student->year_of_passing,
                        'Total Marks' => $student->total_marks,
                    ];
                @endphp

                @foreach ($fields as $label => $value)
                    @if (!is_null($value) && $value !== '')
                        <div class="field-block">
                            <span class="field-label">{{ $label }}</span>
                            <div class="field-value">{{ $value }}</div>
                        </div>
                    @endif
                @endforeach

                {{-- Pre-Board & Board are in PDF, so skip table here if not needed --}}
                {{-- If you have marks arrays, render two tables as before --}}
            </div>

            {{-- Print Button --}}
            <div class="text-center mt-4">
                <button class="btn btn-primary" onclick="window.print()">Print Details</button>
            </div>
        </div>
    </div>
@endsection
