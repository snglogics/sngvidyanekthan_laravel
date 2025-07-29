@extends('layouts.layout')

@section('content')
    <div class="container py-3 py-lg-5">
        <div class="card shadow-lg p-3 p-lg-5">
            <div class="text-center mb-4 mb-lg-5">
                <h2 class="fw-bold text-primary mb-1">SIVAGIRI VIDYANIKETAN</h2>
                <h4 class="text-uppercase">Senior Student Admission Form</h4>
            </div>

            {{-- Success/Error Messages --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form id="admissionForm" action="{{ route('higher-admission.submit') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
 @if($errors->any())
        <input type="hidden" id="hasErrors" value="1">
    @endif
                {{-- Section Navigation --}}
                <div class="d-flex flex-wrap gap-2 mb-4" id="sectionNav">
                    <button type="button" class="btn btn-outline-primary section-nav-btn active" data-section="basic-info">Basic Info</button>
                    <button type="button" class="btn btn-outline-primary section-nav-btn" data-section="parent-details">Parent Details</button>
                    <button type="button" class="btn btn-outline-primary section-nav-btn" data-section="additional-info">Additional Info</button>
                    <button type="button" class="btn btn-outline-primary section-nav-btn" data-section="academic-background">Academic Background</button>
                    <button type="button" class="btn btn-outline-primary section-nav-btn" data-section="other-details">Other Details</button>
                    <button type="button" class="btn btn-outline-primary section-nav-btn" data-section="marks-details">Marks Details</button>
                    <button type="button" class="btn btn-outline-primary section-nav-btn" data-section="documents">Documents</button>
                </div>

                {{-- Photo Upload --}}
                <div class="mb-3 text-center text-md-end">
                    <div style="width: 120px; height: 140px; border: 2px solid #000; background-color: #f8f8f8; display: inline-block;">
                        <label for="headerPhotoInput" style="cursor: pointer; display: block; width: 100%; height: 100%;">
                            <img id="headerPhotoPreview" src="https://via.placeholder.com/120x140?text=Photo" alt="Upload Photo" style="width: 100%; height: 100%; object-fit: cover;">
                            <input type="file" id="headerPhotoInput" name="photo" accept="image/*" onchange="previewHeaderPhoto(event)" style="display: none;" required>
                        </label>
                    </div>
                    <small id="photoError" class="text-danger d-block mt-2"></small>
                </div>

                {{-- Section 1: Basic Information --}}
                <div class="form-section" id="basic-info-section">
                    <h5 class="mb-3 text-primary d-flex justify-content-between align-items-center">
                        <span>Basic Information</span>
                        <button type="button" class="btn btn-sm btn-outline-primary section-next-btn" data-next="parent-details">Next</button>
                    </h5>
                    
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label class="form-label">1. Candidate's Name <span class="text-danger">*</span></label>
                            <input type="text" name="candidate_name" class="form-control" required>
                            <div class="invalid-feedback">Please provide candidate's name.</div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label">2. Reg. No & Roll No <span class="text-danger">*</span></label>
                            <input type="text" name="reg_roll_no" class="form-control" required>
                            <div class="invalid-feedback">Please provide registration/roll number.</div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label">3. Year of Passing the Qualifying Examination <span class="text-danger">*</span></label>
                            <input type="text" name="year_of_passing" class="form-control" required>
                            <div class="invalid-feedback">Please provide year of passing.</div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label">4. Specify whether STATE/CBSE/ICSE <span class="text-danger">*</span></label>
                            <input type="text" name="board_type" class="form-control" required>
                            <div class="invalid-feedback">Please specify board type.</div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label">5. Sex <span class="text-danger">*</span></label>
                            <select name="sex" class="form-control" required>
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                            <div class="invalid-feedback">Please select sex.</div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label">6. Date of Birth <span class="text-danger">*</span></label>
                            <input type="date" name="date_of_birth" class="form-control" required>
                            <div class="invalid-feedback">Please provide date of birth.</div>
                        </div>
                    </div>
                </div>

                {{-- Section 2: Parent Details --}}
                <div class="form-section d-none" id="parent-details-section">
                    <h5 class="mb-3 text-primary d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-sm btn-outline-primary section-prev-btn" data-prev="basic-info">Previous</button>
                        <span>Parent Details</span>
                        <button type="button" class="btn btn-sm btn-outline-primary section-next-btn" data-next="additional-info">Next</button>
                    </h5>
                    
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label class="form-label">Father's Name <span class="text-danger">*</span></label>
                            <input type="text" name="father_name" class="form-control" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label">Father's Occupation</label>
                            <input type="text" name="father_occupation" class="form-control">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label">Mother's Name <span class="text-danger">*</span></label>
                            <input type="text" name="mother_name" class="form-control" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label">Mother's Occupation</label>
                            <input type="text" name="mother_occupation" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Address for Communication <span class="text-danger">*</span></label>
                            <textarea name="address" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label">Phone No <span class="text-danger">*</span></label>
                            <input type="text" name="phone_no" class="form-control" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label">E-mail <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>
                </div>

                {{-- Section 3: Additional Information --}}
                <div class="form-section d-none" id="additional-info-section">
                    <h5 class="mb-3 text-primary d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-sm btn-outline-primary section-prev-btn" data-prev="parent-details">Previous</button>
                        <span>Additional Information</span>
                        <button type="button" class="btn btn-sm btn-outline-primary section-next-btn" data-next="academic-background">Next</button>
                    </h5>
                    
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
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <select name="category" class="form-control" required>
                                <option value="">Select</option>
                                <option value="General">General</option>
                                <option value="SC">SC</option>
                                <option value="ST">ST</option>
                                <option value="OBC">OBC</option>
                                <option value="OEC">OEC</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label">Caste Details</label>
                            <input type="text" name="caste_details" class="form-control">
                        </div>
                    </div>
                </div>

                {{-- Section 4: Academic Background --}}
                <div class="form-section d-none" id="academic-background-section">
                    <h5 class="mb-3 text-primary d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-sm btn-outline-primary section-prev-btn" data-prev="additional-info">Previous</button>
                        <span>Academic Background</span>
                        <button type="button" class="btn btn-sm btn-outline-primary section-next-btn" data-next="other-details">Next</button>
                    </h5>
                    
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

                    <h6 class="mt-4 text-secondary">Educational Background of Parents</h6>
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
                </div>

                {{-- Section 5: Other Details --}}
                <div class="form-section d-none" id="other-details-section">
                    <h5 class="mb-3 text-primary d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-sm btn-outline-primary section-prev-btn" data-prev="academic-background">Previous</button>
                        <span>Other Details</span>
                        <button type="button" class="btn btn-sm btn-outline-primary section-next-btn" data-next="marks-details">Next</button>
                    </h5>
                    
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
                </div>

                {{-- Section 6: Marks Details --}}
                <div class="form-section d-none" id="marks-details-section">
                    <h5 class="mb-3 text-primary d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-sm btn-outline-primary section-prev-btn" data-prev="other-details">Previous</button>
                        <span>Marks Details</span>
                        <button type="button" class="btn btn-sm btn-outline-primary section-next-btn" data-next="documents">Next</button>
                    </h5>
                    
                    <h6 class="mt-3 text-secondary">Marks Scored in Qualifying Pre-Board Exams</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered mt-3" id="preBoardTable">
                            <thead>
                                <tr>
                                    <th width="5%">SI.No.</th>
                                    <th width="35%">Subjects <span class="text-danger">*</span></th>
                                    <th width="30%">Percentage of Marks <span class="text-danger">*</span></th>
                                    <th width="30%">Grade <span class="text-danger">*</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Pre-Board Exams Table --}}
@for ($i = 0; $i < 6; $i++)
    <tr>
        <td>{{ $i+1 }}</td>
        <td>
            <input type="text" name="subjects[]" class="form-control subject-input" 
                   value="{{ old('subjects.'.$i) }}" data-table="preBoard">
        </td>
        <td>
            <input type="text" name="percentages[]" class="form-control percentage-input" 
                   value="{{ old('percentages.'.$i) }}" data-table="preBoard">
        </td>
        <td>
            <input type="text" name="grades[]" class="form-control grade-input" 
                   value="{{ old('grades.'.$i) }}" data-table="preBoard">
        </td>
    </tr>
@endfor
                            </tbody>
                        </table>
                        <div class="invalid-feedback" id="preBoardTableError">At least one subject must be filled in Pre-Board Exams.</div>
                    </div>

                    <h6 class="mt-4 text-secondary">Marks Scored in Qualifying Board Exams</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered mt-3" id="boardTable">
                            <thead>
                                <tr>
                                    <th width="5%">SI.No.</th>
                                    <th width="35%">Subjects <span class="text-danger">*</span></th>
                                    <th width="30%">Percentage of Marks <span class="text-danger">*</span></th>
                                    <th width="30%">Grade <span class="text-danger">*</span></th>
                                </tr>
                            </thead>
                            <tbody>
                               {{-- Board Exams Table --}}
@for ($i = 6; $i < 12; $i++)
    <tr>
        <td>{{ $i-5 }}</td>
        <td>
            <input type="text" name="board_subjects[]" class="form-control subject-input" 
                   value="{{ old('subjects.'.$i) }}" data-table="board">
        </td>
        <td>
            <input type="text" name="board_percentages[]" class="form-control percentage-input" 
                   value="{{ old('percentages.'.$i) }}" data-table="board">
        </td>
        <td>
            <input type="text" name="board_grades[]" class="form-control grade-input" 
                   value="{{ old('grades.'.$i) }}" data-table="board">
        </td>
    </tr>
@endfor
                            </tbody>
                        </table>
                        <div class="invalid-feedback" id="boardTableError">At least one subject must be filled in Board Exams.</div>
                    </div>
                </div>

                {{-- Section 7: Documents --}}
                <div class="form-section d-none" id="documents-section">
                    <h5 class="mb-3 text-primary d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-sm btn-outline-primary section-prev-btn" data-prev="marks-details">Previous</button>
                        <span>Documents</span>
                    </h5>
                    
                    <div class="mb-4">
                        <label class="form-label">Upload the scanned image of the marks table: <span class="text-danger">*</span></label>
                        <input type="file" name="marks_table_image" class="form-control" accept="image/*" required>
                        <div class="invalid-feedback">Please upload marks table image.</div>
                    </div>

                    {{-- Preview and Submit Buttons --}}
                    <div class="mt-4 d-flex flex-column flex-sm-row justify-content-between gap-3">
                        <button type="button" class="btn btn-secondary flex-grow-1 flex-sm-grow-0" onclick="handlePreview()">
                            <i class="bi bi-eye me-2"></i>Preview
                        </button>
                        <button type="submit" id="submitBtn" class="btn btn-primary flex-grow-1 flex-sm-grow-0">
                            <i class="bi bi-send me-2"></i>Submit Application
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Preview Modal --}}
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="previewModalLabel">Application Preview</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <img id="previewPhoto" src="https://via.placeholder.com/120x140?text=Photo" alt="Student Photo" style="width: 120px; height: 140px; object-fit: cover; border: 2px solid #000;">
                    </div>
                    <div id="previewContent" class="preview-content"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('admissionForm').submit()">
                        <i class="bi bi-send me-2"></i>Submit Now
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Section Navigation
        document.querySelectorAll('.section-nav-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const sectionId = this.dataset.section + '-section';
                
                // Hide all sections
                document.querySelectorAll('.form-section').forEach(section => {
                    section.classList.add('d-none');
                });
                
                // Show selected section
                document.getElementById(sectionId).classList.remove('d-none');
                
                // Update active nav button
                document.querySelectorAll('.section-nav-btn').forEach(navBtn => {
                    navBtn.classList.remove('active');
                });
                this.classList.add('active');
                
                // Scroll to top of section
                document.getElementById(sectionId).scrollIntoView({ behavior: 'smooth' });
            });
        });

        // Next/Previous buttons
        document.querySelectorAll('.section-next-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const nextSectionId = this.dataset.next + '-section';
                const currentSection = this.closest('.form-section');
                
                // Validate current section before proceeding
                if (validateSection(currentSection.id)) {
                    currentSection.classList.add('d-none');
                    document.getElementById(nextSectionId).classList.remove('d-none');
                    
                    // Update active nav button
                    document.querySelectorAll('.section-nav-btn').forEach(navBtn => {
                        navBtn.classList.remove('active');
                        if (navBtn.dataset.section === this.dataset.next) {
                            navBtn.classList.add('active');
                        }
                    });
                    
                    // Scroll to top of next section
                    document.getElementById(nextSectionId).scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        document.querySelectorAll('.section-prev-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const prevSectionId = this.dataset.prev + '-section';
                const currentSection = this.closest('.form-section');
                
                currentSection.classList.add('d-none');
                document.getElementById(prevSectionId).classList.remove('d-none');
                
                // Update active nav button
                document.querySelectorAll('.section-nav-btn').forEach(navBtn => {
                    navBtn.classList.remove('active');
                    if (navBtn.dataset.section === this.dataset.prev) {
                        navBtn.classList.add('active');
                    }
                });
                
                // Scroll to top of previous section
                document.getElementById(prevSectionId).scrollIntoView({ behavior: 'smooth' });
            });
        });

        // Validate a section before proceeding
        function validateSection(sectionId) {
            const section = document.getElementById(sectionId);
            let isValid = true;
            
            // Basic validation for required fields
            const requiredInputs = section.querySelectorAll('[required]');
            requiredInputs.forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });
            
            // Special validation for marks tables
            if (sectionId === 'marks-details-section') {
                const preBoardValid = validateMarksTable('preBoard');
                const boardValid = validateMarksTable('board');
                
                if (!preBoardValid || !boardValid) {
                    isValid = false;
                }
            }
            
            if (!isValid) {
                section.scrollIntoView({ behavior: 'smooth' });
            }
            
            return isValid;
        }

        // Validate marks table (at least one subject row filled)
        function validateMarksTable(tableType) {
            const subjectInputs = document.querySelectorAll(`.subject-input[data-table="${tableType}"]`);
            let hasData = false;
            
            subjectInputs.forEach(input => {
                if (input.value.trim()) {
                    hasData = true;
                }
            });
            
            if (!hasData) {
                document.getElementById(`${tableType}TableError`).style.display = 'block';
                return false;
            } else {
                document.getElementById(`${tableType}TableError`).style.display = 'none';
                return true;
            }
        }

        // Photo preview
        function previewHeaderPhoto(event) {
            const output = document.getElementById('headerPhotoPreview');
            const photoError = document.getElementById('photoError');
            
            if (event.target.files && event.target.files[0]) {
                const file = event.target.files[0];
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                const maxSize = 4 * 1024 * 1024; // 4MB
                
                if (!validTypes.includes(file.type)) {
                    photoError.textContent = 'Only JPEG, PNG, JPG images are allowed.';
                    event.target.value = '';
                    return;
                }
                
                if (file.size > maxSize) {
                    photoError.textContent = 'Image size must be less than 4MB.';
                    event.target.value = '';
                    return;
                }
                
                output.src = URL.createObjectURL(file);
                photoError.textContent = '';
            }
        }

        // Form submission
        (() => {
            const form = document.getElementById('admissionForm');
            const submitBtn = document.getElementById('submitBtn');
            
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Validate all sections
                let formIsValid = true;
                document.querySelectorAll('.form-section').forEach(section => {
                    if (!validateSection(section.id)) {
                        formIsValid = false;
                    }
                });
                
                // Check photo
                const photoInput = document.getElementById('headerPhotoInput');
                if (!photoInput.files || !photoInput.files[0]) {
                    document.getElementById('photoError').textContent = 'Please upload a photo.';
                    formIsValid = false;
                } else {
                    document.getElementById('photoError').textContent = '';
                }
                
                if (formIsValid) {
                    // Disable submit button to prevent multiple submissions
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Submitting...';
                    
                    // Submit the form
                    form.submit();
                } else {
                    // Scroll to first error
                    const firstError = document.querySelector('.is-invalid');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            });
        })();

        // Enhanced Preview Functionality
        function handlePreview() {
            const form = document.getElementById('admissionForm');
            const formData = new FormData(form);
            
            // Validate form before showing preview
            if (!validateSection('basic-info-section') || 
                !validateSection('marks-details-section') || 
                !document.getElementById('headerPhotoInput').files[0]) {
                alert('Please complete all required fields before previewing.');
                return;
            }
            
            let previewHtml = `
                <div class="preview-header text-center mb-4">
                    <h4 class="fw-bold text-primary">SIVAGIRI VIDYANIKETAN</h4>
                    <h5 class="text-uppercase">Senior Student Admission Form</h5>
                </div>
                
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="text-primary mb-3 border-bottom pb-2">Student Details</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Candidate's Name:</strong> ${formData.get('candidate_name') || '-'}</p>
                                <p><strong>Reg. No & Roll No:</strong> ${formData.get('reg_roll_no') || '-'}</p>
                                <p><strong>Year of Passing:</strong> ${formData.get('year_of_passing') || '-'}</p>
                                <p><strong>Board Type:</strong> ${formData.get('board_type') || '-'}</p>
                                <p><strong>Sex:</strong> ${formData.get('sex') || '-'}</p>
                                <p><strong>Date of Birth:</strong> ${formData.get('date_of_birth') || '-'}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Annual Income:</strong> ${formData.get('annual_income') || '-'}</p>
                                <p><strong>Nationality:</strong> ${formData.get('nationality') || '-'}</p>
                                <p><strong>Religion & Caste:</strong> ${formData.get('religion_caste') || '-'}</p>
                                <p><strong>Category:</strong> ${formData.get('category') || '-'}</p>
                                <p><strong>Caste Details:</strong> ${formData.get('caste_details') || '-'}</p>
                            </div>
                        </div>
                        
                        <h5 class="text-primary mt-4 mb-3 border-bottom pb-2">Parent Details</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Father's Name:</strong> ${formData.get('father_name') || '-'}</p>
                                <p><strong>Father's Occupation:</strong> ${formData.get('father_occupation') || '-'}</p>
                                <p><strong>Father's Education:</strong> ${formData.get('father_education') || '-'}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Mother's Name:</strong> ${formData.get('mother_name') || '-'}</p>
                                <p><strong>Mother's Occupation:</strong> ${formData.get('mother_occupation') || '-'}</p>
                                <p><strong>Mother's Education:</strong> ${formData.get('mother_education') || '-'}</p>
                            </div>
                        </div>
                        <p><strong>Address:</strong> ${formData.get('address') || '-'}</p>
                        <p><strong>Phone No:</strong> ${formData.get('phone_no') || '-'}</p>
                        <p><strong>Email:</strong> ${formData.get('email') || '-'}</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <img id="previewPhoto" src="${document.getElementById('headerPhotoPreview').src}" 
                             alt="Student Photo" style="width: 150px; height: 180px; object-fit: cover; border: 2px solid #000;" class="mb-3">
                    </div>
                </div>
                
                <h5 class="text-primary mt-4 mb-3 border-bottom pb-2">Academic Background</h5>
                <p><strong>Last Institution:</strong> ${formData.get('last_institution') || '-'}</p>
                <p><strong>Medium of Instruction:</strong> ${formData.get('medium_of_instruction') || '-'}</p>
                <p><strong>Mother Tongue:</strong> ${formData.get('mother_tongue') || '-'}</p>
                
                <h5 class="text-primary mt-4 mb-3 border-bottom pb-2">Other Details</h5>
                <p><strong>Siblings:</strong> ${formData.get('siblings') || '-'}</p>
                <p><strong>Local Guardian:</strong> ${formData.get('local_guardian') || '-'}</p>
                <p><strong>Hobbies:</strong> ${formData.get('hobbies') || '-'}</p>
                <p><strong>Major Games:</strong> ${formData.get('major_games') || '-'}</p>
                <p><strong>Achievements:</strong> ${formData.get('co_curricular_achievements') || '-'}</p>
            `;
            
            // Pre-Board Exams
            previewHtml += `<h5 class="text-primary mt-4 mb-3 border-bottom pb-2">Pre-Board Exam Marks</h5>`;
            previewHtml += `<div class="table-responsive"><table class="table table-bordered"><thead><tr><th>Subject</th><th>% Marks</th><th>Grade</th></tr></thead><tbody>`;
            
            const preBoardSubjects = formData.getAll('subjects[]');
            const preBoardPercentages = formData.getAll('percentages[]');
            const preBoardGrades = formData.getAll('grades[]');
            
            for (let i = 0; i < preBoardSubjects.length; i++) {
                if (preBoardSubjects[i]) {
                    previewHtml += `
                        <tr>
                            <td>${preBoardSubjects[i]}</td>
                            <td>${preBoardPercentages[i] || '-'}</td>
                            <td>${preBoardGrades[i] || '-'}</td>
                        </tr>
                    `;
                }
            }
            previewHtml += `</tbody></table></div>`;
            
            // Board Exams
            previewHtml += `<h5 class="text-primary mt-4 mb-3 border-bottom pb-2">Board Exam Marks</h5>`;
            previewHtml += `<div class="table-responsive"><table class="table table-bordered"><thead><tr><th>Subject</th><th>% Marks</th><th>Grade</th></tr></thead><tbody>`;
            
            const boardSubjects = formData.getAll('board_subjects[]');
            const boardPercentages = formData.getAll('board_percentages[]');
            const boardGrades = formData.getAll('board_grades[]');
            
            for (let i = 0; i < boardSubjects.length; i++) {
                if (boardSubjects[i]) {
                    previewHtml += `
                        <tr>
                            <td>${boardSubjects[i]}</td>
                            <td>${boardPercentages[i] || '-'}</td>
                            <td>${boardGrades[i] || '-'}</td>
                        </tr>
                    `;
                }
            }
            previewHtml += `</tbody></table></div>`;
            
            // Documents
            previewHtml += `<h5 class="text-primary mt-4 mb-3 border-bottom pb-2">Documents</h5>`;
            previewHtml += `<p><strong>Marks Table Image:</strong> ${formData.get('marks_table_image')?.name || 'Not uploaded'}</p>`;
            
            document.getElementById('previewContent').innerHTML = previewHtml;
            
            // Update the photo in preview modal
            if (document.getElementById('headerPhotoInput').files && document.getElementById('headerPhotoInput').files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewPhoto').src = e.target.result;
                };
                reader.readAsDataURL(document.getElementById('headerPhotoInput').files[0]);
            }
            
            // Show modal
            new bootstrap.Modal(document.getElementById('previewModal')).show();
        }
    </script>

    <style>
        .form-section {
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
            margin-bottom: 20px;
            border: 1px solid #eee;
        }
        
        .section-nav-btn {
            min-width: 120px;
            margin-bottom: 5px;
        }
        
        .section-nav-btn.active {
            background-color: #0d6efd;
            color: white;
        }
        
        .preview-content {
            max-height: 60vh;
            overflow-y: auto;
            padding: 15px;
            background-color: #fff;
            border-radius: 5px;
            border: 1px solid #dee2e6;
        }
        
        .preview-content p {
            margin-bottom: 10px;
        }
        
        .preview-header {
            padding-bottom: 15px;
            margin-bottom: 20px;
            border-bottom: 2px solid #0d6efd;
        }
        
        @media (max-width: 767.98px) {
            .section-nav-btn {
                min-width: 100px;
                font-size: 0.8rem;
                padding: 5px 10px;
            }
            
            .form-section {
                padding: 15px;
            }
        }
        
        /* Make tables in preview look better */
        .preview-content table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }
        
        .preview-content table th,
        .preview-content table td {
            padding: 0.75rem;
            vertical-align: top;
            border: 1px solid #dee2e6;
        }
        
        .preview-content table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
            background-color: #f8f9fa;
        }
    </style>
@endsection