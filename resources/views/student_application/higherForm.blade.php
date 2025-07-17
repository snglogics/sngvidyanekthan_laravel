@extends('layouts.layout')

@section('content')
    <div class="container py-3 py-lg-5">
        <div class="card shadow-lg p-3 p-lg-5">
            <div class="text-center mb-4 mb-lg-5">
                <h2 class="fw-bold text-primary mb-1">SIVAGIRI VIDYANIKETAN</h2>
                <h4 class="text-uppercase">Senior Student Admission Form</h4>
            </div>

            {{-- Success Message --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                <script>
                    alert("{{ session('success') }}");
                </script>
            @endif

            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="admissionForm" action="{{ route('higher-admission.submit') }}" method="POST"
                enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf

                {{-- Photo Upload --}}
                <div class="mb-3 text-center text-md-end">
                    <div
                        style="width: 120px; height: 140px; border: 2px solid #000; background-color: #f8f8f8; display: inline-block;">
                        <label for="headerPhotoInput" style="cursor: pointer; display: block; width: 100%; height: 100%;">
                            <img id="headerPhotoPreview" src="https://via.placeholder.com/120x140?text=Photo"
                                alt="Upload Photo" style="width: 100%; height: 100%; object-fit: cover;">
                            <input type="file" id="headerPhotoInput" name="photo" accept="image/*"
                                onchange="previewHeaderPhoto(event)" style="display: none;">
                        </label>
                    </div>
                    <small id="photoError" class="text-danger d-block mt-2"></small>
                </div>

                {{-- Student Details --}}
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">1. Candidate's Name</label>
                        <input type="text" name="candidate_name" class="form-control" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">2. Reg. No & Roll No</label>
                        <input type="text" name="reg_roll_no" class="form-control" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">3. Year of Passing the Qualifying Examination</label>
                        <input type="text" name="year_of_passing" class="form-control" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">4. Specify whether STATE/CBSE/ICSE</label>
                        <input type="text" name="board_type" class="form-control" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">5. Sex</label>
                        <select name="sex" class="form-control" required>
                            <option value="">Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">6. Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control" required>
                    </div>
                </div>

                {{-- Parent Details --}}
                <h5 class="mt-4 mt-lg-5 text-primary">Parent's Details</h5>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Father's Name</label>
                        <input type="text" name="father_name" class="form-control">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Father's Occupation</label>
                        <input type="text" name="father_occupation" class="form-control">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Mother's Name</label>
                        <input type="text" name="mother_name" class="form-control">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Mother's Occupation</label>
                        <input type="text" name="mother_occupation" class="form-control">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Address for Communication</label>
                        <textarea name="address" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Phone No</label>
                        <input type="text" name="phone_no" class="form-control">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">E-mail</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                </div>

                {{-- Additional Details --}}
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">7. Annual Income</label>
                        <input type="text" name="annual_income" class="form-control">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">8. Nationality</label>
                        <input type="text" name="nationality" class="form-control">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Religion & Caste (Optional)</label>
                        <input type="text" name="religion_caste" class="form-control">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-control">
                            <option value="">Select</option>
                            <option value="General">General</option>
                            <option value="SC">SC</option>
                            <option value="ST">ST</option>
                            <option value="OBC">OBC</option>
                            <option value="OEC">OEC</option>
                        </select>
                    </div>
                </div>

                {{-- Academic Background --}}
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Name of the Institution last attended</label>
                        <input type="text" name="last_institution" class="form-control">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Medium of Instruction at Present</label>
                        <input type="text" name="medium_of_instruction" class="form-control">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Mother Tongue</label>
                        <input type="text" name="mother_tongue" class="form-control">
                    </div>
                </div>

                {{-- Educational Background of Parents --}}
                <h5 class="mt-4 mt-lg-5 text-primary">Educational Background of Parents</h5>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Father's Educational Background</label>
                        <input type="text" name="father_education" class="form-control">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Mother's Educational Background</label>
                        <input type="text" name="mother_education" class="form-control">
                    </div>
                </div>

                {{-- Other Details --}}
                <h5 class="mt-4 mt-lg-5 text-primary">Other Details</h5>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Names & Classes of Siblings Already in the School</label>
                        <textarea name="siblings" class="form-control"></textarea>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Name of Local Guardian with Phone Number</label>
                        <textarea name="local_guardian" class="form-control"></textarea>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Hobbies</label>
                        <textarea name="hobbies" class="form-control"></textarea>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Major Games and Track Events</label>
                        <textarea name="major_games" class="form-control"></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Co-curricular Achievements (District/State Level)</label>
                        <textarea name="co_curricular_achievements" class="form-control"></textarea>
                    </div>
                </div>

                {{-- Marks Scored in Qualifying Exams --}}
                <h5 class="mt-4 mt-lg-5 text-primary">Marks Scored in Qualifying Pre-Board Exams</h5>
                <div class="table-responsive">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>SI.No.</th>
                                <th>Subjects</th>
                                <th>Percentage of Marks</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= 6; $i++)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td><input type="text" name="subjects[]" class="form-control"></td>
                                    <td><input type="text" name="percentages[]" class="form-control"></td>
                                    <td><input type="text" name="grades[]" class="form-control"></td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                {{-- Marks Scored in Qualifying Exams --}}
                <h5 class="mt-4 mt-lg-5 text-primary">Marks Scored in Qualifying Board Exams</h5>
                <div class="table-responsive">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>SI.No.</th>
                                <th>Subjects</th>
                                <th>Percentage of Marks</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= 6; $i++)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td><input type="text" name="subjects[]" class="form-control"></td>
                                    <td><input type="text" name="percentages[]" class="form-control"></td>
                                    <td><input type="text" name="grades[]" class="form-control"></td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                {{-- Upload Marks Table Image --}}
                <div class="mb-4">
                    <label class="form-label">Upload the scanned image of the marks table:</label>
                    <input type="file" name="marks_table_image" class="form-control" accept="image/*" required>
                </div>

                {{-- Preview and Submit Buttons --}}
                <div class="mt-4 d-flex flex-column flex-sm-row justify-content-between gap-3">
                    {{-- <button type="button" class="btn btn-secondary flex-grow-1 flex-sm-grow-0"
                        onclick="handlePreview()">Preview</button> --}}
                    <button type="submit" id="submitBtn" class="btn btn-primary flex-grow-1 flex-sm-grow-0">Submit
                        Application</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Preview Modal --}}
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewModalLabel">Form Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <img id="previewPhoto" src="https://via.placeholder.com/120x140?text=Photo" alt="Student Photo"
                            style="width: 120px; height: 140px; object-fit: cover; border: 2px solid #000;">
                    </div>
                    <div id="previewContent" class="preview-content"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        (() => {
            'use strict'
            const form = document.getElementById('admissionForm');
            const photoInput = document.getElementById('headerPhotoInput');
            const photoError = document.getElementById('photoError');
            const submitBtn = document.getElementById('submitBtn');

            form.addEventListener('submit', function(e) {
                // Clear previous error
                photoError.textContent = '';

                // Check photo input
                const isPhotoValid = photoInput.files && photoInput.files.length > 0;

                // Check native validation and photo
                if (!form.checkValidity() || !isPhotoValid) {
                    e.preventDefault();
                    e.stopPropagation();

                    if (!isPhotoValid) {
                        alert('Please upload a photo before submitting the form.');
                    }

                    form.classList.add('was-validated');
                    return;
                }

                // All validations passed — now it's safe to update button
                submitBtn.disabled = true;
                submitBtn.textContent = 'Submitting...';
            });
        })();

        function previewHeaderPhoto(event) {
            const output = document.getElementById('headerPhotoPreview');
            const photoError = document.getElementById('photoError');

            output.src = URL.createObjectURL(event.target.files[0]);
            photoError.textContent = ''; // Clear error if a new photo is chosen
        }

        function handlePreview() {
            const form = document.getElementById('admissionForm');
            const formData = new FormData(form);
            let previewHtml = "<h5 class='text-primary'>Student Details</h5><ul class='list-group mb-3'>";

            const fields = [
                ['candidate_name', "Candidate's Name"],
                ['reg_roll_no', "Reg. No & Roll No"],
                ['year_of_passing', "Year of Passing"],
                ['board_type', "Board Type"],
                ['sex', "Sex"],
                ['date_of_birth', "Date of Birth"],
                ['father_name', "Father's Name"],
                ['father_occupation', "Father's Occupation"],
                ['mother_name', "Mother's Name"],
                ['mother_occupation', "Mother's Occupation"],
                ['address', "Address"],
                ['phone_no', "Phone No"],
                ['email', "Email"],
                ['annual_income', "Annual Income"],
                ['nationality', "Nationality"],
                ['religion_caste', "Religion & Caste"],
                ['category', "Category"],
                ['last_institution', "Last Institution"],
                ['medium_of_instruction', "Medium of Instruction"],
                ['mother_tongue', "Mother Tongue"],
                ['father_education', "Father's Education"],
                ['mother_education', "Mother's Education"],
                ['siblings', "Siblings"],
                ['local_guardian', "Local Guardian"],
                ['hobbies', "Hobbies"],
                ['major_games', "Major Games"],
                ['co_curricular_achievements', "Co-curricular Achievements"],
            ];

            fields.forEach(([name, label]) => {
                previewHtml +=
                    `<li class="list-group-item"><strong>${label}:</strong> ${formData.get(name) || '-'}</li>`;
            });

            previewHtml += "</ul>";

            previewHtml +=
                `<h5 class='text-primary'>Pre-Board Exam Marks</h5><div class="table-responsive"><table class="table table-bordered"><thead><tr><th>Subject</th><th>% Marks</th><th>Grade</th></tr></thead><tbody>`;
            const subjects = formData.getAll('subjects[]');
            const percentages = formData.getAll('percentages[]');
            const grades = formData.getAll('grades[]');
            for (let i = 0; i < subjects.length; i++) {
                previewHtml += `<tr><td>${subjects[i]}</td><td>${percentages[i]}</td><td>${grades[i]}</td></tr>`;
            }
            previewHtml += `</tbody></table></div>`;

            document.getElementById('previewContent').innerHTML = previewHtml;

            // Update the photo in preview modal
            if (photoInput.files && photoInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewPhoto').src = e.target.result;
                };
                reader.readAsDataURL(photoInput.files[0]);
            }

            new bootstrap.Modal(document.getElementById('previewModal')).show();
        }
    </script>

    <style>
        /* Responsive adjustments */
        @media (max-width: 767.98px) {
            .card {
                padding: 1.5rem;
            }

            .py-5 {
                padding-top: 2rem !important;
                padding-bottom: 2rem !important;
            }

            h2 {
                font-size: 1.5rem;
            }

            h4 {
                font-size: 1.2rem;
            }

            .form-label {
                font-size: 0.9rem;
            }
        }

        .preview-content {
            max-height: 60vh;
            overflow-y: auto;
        }
    </style>
@endsection
