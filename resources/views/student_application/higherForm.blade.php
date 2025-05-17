@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg p-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary mb-1">SREENARAYANA VIDYANIKETAN</h2>
            <h4 class="text-uppercase">Senior Student Admission Form</h4>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            <script>alert("{{ session('success') }}");</script>
        @endif

        {{-- Error Messages --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="admissionForm" action="{{ route('higher-admission.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Photo Upload --}}
            <div class="mb-3 text-end">
                <div style="width: 120px; height: 140px; border: 2px solid #000; background-color: #f8f8f8; float: right;">
                    <label for="headerPhotoInput" style="cursor: pointer; display: block; width: 100%; height: 100%;">
                        <img id="headerPhotoPreview" 
                            src="https://via.placeholder.com/120x140?text=Photo" 
                            alt="Upload Photo" 
                            style="width: 100%; height: 100%; object-fit: cover;">
                        <input type="file" id="headerPhotoInput" name="photo" accept="image/*" onchange="previewHeaderPhoto(event)" style="display: none;">
                    </label>
                </div>
            </div>

            {{-- Student Details --}}
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label">1. Candidate's Name</label>
                    <input type="text" name="candidate_name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">2. Reg. No & Roll No</label>
                    <input type="text" name="reg_roll_no" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">3. Year of Passing the Qualifying Examination</label>
                    <input type="text" name="year_of_passing" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">4. Specify whether STATE/CBSE/ICSE</label>
                    <input type="text" name="board_type" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">5. Sex</label>
                    <select name="sex" class="form-control" required>
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">6. Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control" required>
                </div>
            </div>

            {{-- Parent Details --}}
            <h5 class="mt-5 text-primary">Parent's Details</h5>
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label">Father's Name</label>
                    <input type="text" name="father_name" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Father's Occupation</label>
                    <input type="text" name="father_occupation" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Mother's Name</label>
                    <input type="text" name="mother_name" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Mother's Occupation</label>
                    <input type="text" name="mother_occupation" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Address for Communication</label>
                    <textarea name="address" class="form-control" rows="3"></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone No</label>
                    <input type="text" name="phone_no" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control">
                </div>
            </div>
            {{-- Additional Details --}}
           
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label">7. Annual Income</label>
                    <input type="text" name="annual_income" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">8. Nationality</label>
                    <input type="text" name="nationality" class="form-control">
                </div>
</div>
                <div class="row g-3">
                <div class="col-md-6">
                <label class="form-label">Religion & Caste (Optional)</label>
                <input type="text" name="religion_caste" class="form-control">
                </div>

                <div class="col-md-6">
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
            <!-- <h5 class="mt-5 text-primary">Academic Background</h5> -->
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label">Name of the Institution last attended</label>
                    <input type="text" name="last_institution" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Medium of Instruction at Present</label>
                    <input type="text" name="medium_of_instruction" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Mother Tongue</label>
                    <input type="text" name="mother_tongue" class="form-control">
                </div>
            </div>
   
            {{-- Educational Background of Parents --}}
            <h5 class="mt-5 text-primary">Educational Background of Parents</h5>
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label">Father's Educational Background</label>
                    <input type="text" name="father_education" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Mother's Educational Background</label>
                    <input type="text" name="mother_education" class="form-control">
                </div>
            </div>
    <div class="row g-4">
    <h5 class="mt-5 text-primary">Other Details</h5>
                <div class="col-md-6">
                    
                    <label class="form-label">Names & Classes of Siblings Already in the School</label>
                    <textarea name="siblings" class="form-control"></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Name of Local Guardian with Phone Number</label>
                    <textarea name="local_guardian" class="form-control"></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Hobbies</label>
                    <textarea name="hobbies" class="form-control"></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Major Games and Track Events</label>
                    <textarea name="major_games" class="form-control"></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Co-curricular Achievements (District/State Level)</label>
                    <textarea name="co_curricular_achievements" class="form-control"></textarea>
                </div>
            </div>

          

           

            {{-- Marks Scored in Qualifying Exams --}}
            <h5 class="mt-5 text-primary">Marks Scored in Qualifying Exams</h5>
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
                    @for($i = 1; $i <= 6; $i++)
                    <tr>
                        <td>{{ $i }}</td>
                        <td><input type="text" name="subjects[]" class="form-control"></td>
                        <td><input type="text" name="percentages[]" class="form-control"></td>
                        <td><input type="text" name="grades[]" class="form-control"></td>
                    </tr>
                    @endfor
                </tbody>
            </table>

            {{-- Marks Scored in Qualifying Exams --}}
            <h5 class="mt-5 text-primary">Marks Scored in Qualifying Exams</h5>
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
                    @for($i = 1; $i <= 6; $i++)
                    <tr>
                        <td>{{ $i }}</td>
                        <td><input type="text" name="subjects[]" class="form-control"></td>
                        <td><input type="text" name="percentages[]" class="form-control"></td>
                        <td><input type="text" name="grades[]" class="form-control"></td>
                    </tr>
                    @endfor
                </tbody>
            </table>

            {{-- Upload Marks Table Image --}}
            <div class="mb-4">
                <label class="form-label">Upload the scanned image of the marks table:</label>
                <input type="file" name="marks_table_image" class="form-control" accept="image/*" required>
            </div>

            {{-- Submit Button --}}
            <!-- <button type="submit" class="btn btn-primary w-100 mt-4">Submit Application</button> -->

            {{-- Preview and Submit Buttons --}}
            <div class="mt-4 d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" onclick="showPreview()">Preview</button>
                <button type="submit" class="btn btn-primary">Submit Application</button>
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
                    <img id="previewPhoto" src="https://via.placeholder.com/120x140?text=Photo" alt="Student Photo" style="width: 120px; height: 140px; object-fit: cover; border: 2px solid #000;">
                </div>
                <div id="previewContent"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function previewHeaderPhoto(event) {
        const input = event.target;
        const reader = new FileReader();
        reader.onload = function () {
            document.getElementById('headerPhotoPreview').src = reader.result;
        }
        if (input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }

    function showPreview() {
        const form = document.getElementById('admissionForm');
        const previewContent = document.getElementById('previewContent');
        previewContent.innerHTML = '';
    Array.from(form.elements).forEach(element => {
            if (element.name && element.name !== 'photo' && element.type !== 'submit') {
                previewContent.innerHTML += `
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><strong>${element.previousElementSibling.innerText}</strong></label>
                        <div class="form-control">${element.value}</div>
                    </div>
                `;
            }
        });

        new bootstrap.Modal(document.getElementById('previewModal')).show();
    }
</script>
@endsection
