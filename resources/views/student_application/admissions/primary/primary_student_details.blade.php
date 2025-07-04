@extends('layouts.admin')

@section('title', 'Primary Student Application Details')

@section('styles')
    <style>
        @media print {
            @page {
                size: A4;
                margin: .5cm;
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
        }
    </style>
@endsection

@section('content')
    <div id="printSection" class="py-5">
        <div class="card shadow-lg p-5">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-primary">Sivagiri
                    Vidyaniketan</h2>
                <h4 class="text-uppercase">Primary Student Application Details</h4>
            </div>

            {{-- Photo --}}
            <div class="text-center mb-4">
                <img src="{{ $student->photo_url }}" alt="Photo"
                    style="width:120px; height:140px; object-fit:cover; border:2px solid #000;">
            </div>

            <div class="row">
                @php
                    $fields = [
                        'Class' => $student->class,
                        'Name' => $student->pupil_name,
                        'Gender' => $student->gender,
                        'Date of Birth' => $student->date_of_birth,
                        'Father Name' => $student->father_name,
                        'Father Occupation' => $student->father_occupation,
                        'Mother Name' => $student->mother_name,
                        'Mother Occupation' => $student->mother_occupation,
                        'Address' => $student->address,
                        'Mobile Number' => $student->mobile_number,
                        'WhatsApp Number' => $student->Whatsapp_number,
                        'Aadhaar No' => $student->aadhar,
                        'Email' => $student->email,
                        'Annual Income' => $student->annual_income,
                        'Nationality' => $student->nationality,
                        'Religion' => $student->religion,
                        'Mother Tongue' => $student->mother_toungue,
                        'Father Education' => $student->father_education,
                        'Mother Education' => $student->mother_education,
                        'Total Members' => $student->total_members,
                        'Siblings' => $student->siblings,
                        'Local Guardian' => $student->local_guardian,
                        'Hobbies' => $student->hobbies,
                        'Blood Group' => $student->blood_group,
                        'Boarding Point' => $student->boarding_point,
                    ];
                @endphp

                @foreach ($fields as $label => $value)
                    @if (!is_null($value) && $value !== '')
                        <div class="field-block" style="margin-bottom:10px">
                            <span class="field-label" style="font-weight: bold;">{{ $label }}</span>
                            <div class="field-value">{{ $value }}</div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="text-center mt-4">
                <button class="btn btn-primary" onclick="window.print()">Print Details</button>
            </div>
        </div>
    </div>
@endsection
