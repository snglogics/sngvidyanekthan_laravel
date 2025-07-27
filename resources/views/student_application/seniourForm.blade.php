@extends('layouts.layout')

@section('content')
    <div class="container py-3 py-md-5">
        <div class="card shadow-lg p-3 p-md-5">
            <div class="text-center mb-4 mb-md-5">
                <h5 class="text-uppercase fw-bold mb-1" style="font-size: clamp(14px, 3vw, 18px);">"One Caste One Religion One God for Man"</h5>
                <h2 class="fw-bold text-primary mb-1" style="font-size: clamp(1.5rem, 4vw, 2rem);">SIVAGIRI VIDYANIKETAN</h2>
                <h5 class="text-uppercase" style="font-size: clamp(1rem, 2.5vw, 1.25rem);">Student Admission Form</h5>
                <p class="mb-1" style="font-size: clamp(12px, 2.5vw, 14px);">(Managed by Sree Narayana Dharma Mangalam Trust, Singall Medu, Vatakara)</p>
                <h4 class="fw-bold text-decoration-underline mt-2" style="font-size: clamp(1.1rem, 3vw, 1.4rem);">Application for Admission</h4>
            </div>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
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

            <form action="{{ route('admissions.submit') }}" method="POST" enctype="multipart/form-data" id="admissionForm">
                @csrf

                {{-- Photo Upload --}}
                <div class="mb-3 text-center text-md-end">
                    <div style="width: 120px; height: 140px; border: 2px solid #000; background-color: #f8f8f8; display: inline-block;">
                        <label for="headerPhotoInput" style="cursor: pointer; display: block; width: 100%; height: 100%;">
                            <img id="headerPhotoPreview" src="https://via.placeholder.com/120x140?text=Photo" alt="Upload Photo" style="width: 100%; height: 100%; object-fit: cover;">
                            <input type="file" id="headerPhotoInput" name="photo" accept="image/*" onchange="previewHeaderPhoto(event)" style="display: none;">
                        </label>
                    </div>
                    @error('photo')
                        <small class="text-danger d-block mt-2">Please upload the photo again</small>
                    @enderror
                </div>

                {{-- Basic Details --}}
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Class to which admission is sought</label>
                        <input type="text" name="admission_class" class="form-control @error('admission_class') is-invalid @enderror" value="{{ old('admission_class') }}" required>
                        @error('admission_class')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Student's Name (in block letters)</label>
                        <input type="text" name="pupil_name" class="form-control @error('pupil_name') is-invalid @enderror" value="{{ old('pupil_name') }}" required>
                        @error('pupil_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                            <option value="">Select</option>
                            <option value="Boy" {{ old('gender') == 'Boy' ? 'selected' : '' }}>Boy</option>
                            <option value="Girl" {{ old('gender') == 'Girl' ? 'selected' : '' }}>Girl</option>
                            <option value="Transgender" {{ old('gender') == 'Transgender' ? 'selected' : '' }}>Transgender</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth') }}" required>
                        @error('date_of_birth')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Aadhaar No.</label>
                        <input type="text" name="aadhaar_no" class="form-control @error('aadhaar_no') is-invalid @enderror" value="{{ old('aadhaar_no') }}" required>
                        @error('aadhaar_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Last Institution Attended</label>
                        <input type="text" name="last_institution_attended" class="form-control @error('last_institution_attended') is-invalid @enderror" value="{{ old('last_institution_attended') }}">
                        @error('last_institution_attended')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Year of Passing</label>
                        <input type="text" name="year_of_passing" class="form-control @error('year_of_passing') is-invalid @enderror" value="{{ old('year_of_passing') }}">
                        @error('year_of_passing')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Total Marks Obtained</label>
                        <input type="text" name="total_marks" class="form-control @error('total_marks') is-invalid @enderror" value="{{ old('total_marks') }}">
                        @error('total_marks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Parent Details --}}
                <h5 class="mt-4 mt-md-5 text-primary">Parent's Details</h5>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Father's Name</label>
                        <input type="text" name="father_name" class="form-control @error('father_name') is-invalid @enderror" value="{{ old('father_name') }}" required>
                        @error('father_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Father's Occupation</label>
                        <input type="text" name="father_occupation" class="form-control @error('father_occupation') is-invalid @enderror" value="{{ old('father_occupation') }}">
                        @error('father_occupation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Mother's Name</label>
                        <input type="text" name="mother_name" class="form-control @error('mother_name') is-invalid @enderror" value="{{ old('mother_name') }}" required>
                        @error('mother_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Mother's Occupation</label>
                        <input type="text" name="mother_occupation" class="form-control @error('mother_occupation') is-invalid @enderror" value="{{ old('mother_occupation') }}">
                        @error('mother_occupation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Annual Income</label>
                        <input type="text" name="annual_income" class="form-control @error('annual_income') is-invalid @enderror" value="{{ old('annual_income') }}">
                        @error('annual_income')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Parent's Education</label>
                        <input type="text" name="parent_education" class="form-control @error('parent_education') is-invalid @enderror" value="{{ old('parent_education') }}">
                        @error('parent_education')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Contact Details --}}
                <h5 class="mt-4 mt-md-5 text-primary">Contact Details</h5>
                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <label class="form-label">Phone No.</label>
                        <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" required>
                        @error('phone_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label">Whatsapp No.</label>
                        <input type="text" name="whatsapp_number" class="form-control @error('whatsapp_number') is-invalid @enderror" value="{{ old('whatsapp_number') }}">
                        @error('whatsapp_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Address Details --}}
                <div class="mt-3 mt-md-4">
                    <label class="form-label">Address for Communication</label>
                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3" required>{{ old('address') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Family Details --}}
                <h5 class="mt-4 mt-md-5 text-primary">Family Details</h5>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Family Members</label>
                        <textarea name="family_members" class="form-control @error('family_members') is-invalid @enderror" rows="2">{{ old('family_members') }}</textarea>
                        @error('family_members')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Siblings (if any)</label>
                        <textarea name="siblings" class="form-control @error('siblings') is-invalid @enderror" rows="2">{{ old('siblings') }}</textarea>
                        @error('siblings')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Local Guardian (if any)</label>
                        <input type="text" name="local_guardian" class="form-control @error('local_guardian') is-invalid @enderror" value="{{ old('local_guardian') }}">
                        @error('local_guardian')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Other Details --}}
                <h5 class="mt-4 mt-md-5 text-primary">Other Details</h5>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Nationality</label>
                        <input type="text" name="nationality" class="form-control @error('nationality') is-invalid @enderror" value="{{ old('nationality') }}">
                        @error('nationality')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Religion & Caste (Optional)</label>
                        <input type="text" name="religion_caste" class="form-control @error('religion_caste') is-invalid @enderror" value="{{ old('religion_caste') }}">
                        @error('religion_caste')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Mother Tongue</label>
                        <input type="text" name="mother_tongue" class="form-control @error('mother_tongue') is-invalid @enderror" value="{{ old('mother_tongue') }}">
                        @error('mother_tongue')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Blood Group</label>
                        <input type="text" name="blood_group" class="form-control @error('blood_group') is-invalid @enderror" value="{{ old('blood_group') }}">
                        @error('blood_group')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Medium of Instruction</label>
                        <input type="text" name="medium_of_instruction" class="form-control @error('medium_of_instruction') is-invalid @enderror" value="{{ old('medium_of_instruction') }}">
                        @error('medium_of_instruction')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Immunization Status</label>
                        <input type="text" name="immunization_status" class="form-control @error('immunization_status') is-invalid @enderror" value="{{ old('immunization_status') }}">
                        @error('immunization_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Interests and Activities --}}
                <h5 class="mt-4 mt-md-5 text-primary">Interests and Activities</h5>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Hobbies</label>
                        <textarea name="hobbies" class="form-control @error('hobbies') is-invalid @enderror" rows="2">{{ old('hobbies') }}</textarea>
                        @error('hobbies')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Games/Sports Played</label>
                        <textarea name="games_played" class="form-control @error('games_played') is-invalid @enderror" rows="2">{{ old('games_played') }}</textarea>
                        @error('games_played')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Co-curricular Achievements</label>
                        <textarea name="cocurricular_achievements" class="form-control @error('cocurricular_achievements') is-invalid @enderror" rows="2">{{ old('cocurricular_achievements') }}</textarea>
                        @error('cocurricular_achievements')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">CCA Options Interested In</label>
                        <textarea name="cca_options" class="form-control @error('cca_options') is-invalid @enderror" rows="2">{{ old('cca_options') }}</textarea>
                        @error('cca_options')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Declaration --}}
                <div class="mt-4 mt-md-5 border-top pt-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="declaration" name="declaration" {{ old('declaration') ? 'checked' : '' }} required>
                        <label class="form-check-label" for="declaration">
                            I hereby declare that all the information provided in this form is true and correct to the best of my knowledge.
                        </label>
                    </div>
                    @error('declaration')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex flex-column flex-md-row justify-content-between mt-4 gap-2">
                    <button type="button" class="btn btn-outline-primary flex-grow-1 flex-md-grow-0" id="preview-btn">
                        <i class="fas fa-eye me-2"></i>Preview Application
                    </button>
                    <button type="submit" id="submit-btn" class="btn btn-primary flex-grow-1 flex-md-grow-0">
                        <i class="fas fa-paper-plane me-2"></i>Submit Application
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Preview Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewModalLabel">Application Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="preview-content">
                    <!-- Preview content will be inserted here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="printPreview()">
                        <i class="fas fa-print me-2"></i>Print
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewHeaderPhoto(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('headerPhotoPreview').src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        // Preview functionality
        document.getElementById('preview-btn').addEventListener('click', function() {
            // Create a FormData object from the form
            const formData = new FormData(document.getElementById('admissionForm'));
            
            // Convert FormData to a plain object
            const formValues = {};
            formData.forEach((value, key) => {
                formValues[key] = value;
            });

            // Generate HTML for preview
            const previewHtml = generatePreviewHtml(formValues);
            
            // Insert into modal
            document.getElementById('preview-content').innerHTML = previewHtml;
            
            // Show modal
            const previewModal = new bootstrap.Modal(document.getElementById('previewModal'));
            previewModal.show();
        });

        function generatePreviewHtml(data) {
            return `
                <div class="preview-container">
                    <div class="text-center mb-4">
                        <h5 class="text-uppercase fw-bold mb-1">"One Caste One Religion One God for Man"</h5>
                        <h2 class="fw-bold text-primary mb-1">SIVAGIRI VIDYANIKETAN</h2>
                        <h5 class="text-uppercase">Student Admission Form</h5>
                        <p class="mb-1">(Managed by Sree Narayana Dharma Mangalam Trust, Singall Medu, Vatakara)</p>
                        <h4 class="fw-bold text-decoration-underline mt-2">Application for Admission</h4>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="preview-section">
                                <h5 class="text-primary border-bottom pb-2">Basic Details</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Class:</strong> ${data.admission_class || 'N/A'}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Student Name:</strong> ${data.pupil_name || 'N/A'}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Gender:</strong> ${data.gender || 'N/A'}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Date of Birth:</strong> ${data.date_of_birth || 'N/A'}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Aadhaar No:</strong> ${data.aadhaar_no || 'N/A'}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Last Institution:</strong> ${data.last_institution_attended || 'N/A'}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="preview-section">
                                <h5 class="text-primary border-bottom pb-2">Parent's Details</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Father's Name:</strong> ${data.father_name || 'N/A'}</p>
                                        <p><strong>Occupation:</strong> ${data.father_occupation || 'N/A'}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Mother's Name:</strong> ${data.mother_name || 'N/A'}</p>
                                        <p><strong>Occupation:</strong> ${data.mother_occupation || 'N/A'}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Annual Income:</strong> ${data.annual_income || 'N/A'}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Parent's Education:</strong> ${data.parent_education || 'N/A'}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="preview-section">
                                <h5 class="text-primary border-bottom pb-2">Contact Details</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Phone:</strong> ${data.phone_number || 'N/A'}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><strong>WhatsApp:</strong> ${data.whatsapp_number || 'N/A'}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><strong>Email:</strong> ${data.email || 'N/A'}</p>
                                    </div>
                                </div>
                                <p><strong>Address:</strong> ${data.address || 'N/A'}</p>
                            </div>

                            <div class="preview-section">
                                <h5 class="text-primary border-bottom pb-2">Family Details</h5>
                                <p><strong>Family Members:</strong> ${data.family_members || 'N/A'}</p>
                                <p><strong>Siblings:</strong> ${data.siblings || 'N/A'}</p>
                                <p><strong>Local Guardian:</strong> ${data.local_guardian || 'N/A'}</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="text-center">
                                <img id="previewPhoto" src="${document.getElementById('headerPhotoPreview').src}" 
                                    alt="Student Photo" class="img-thumbnail mb-3" style="max-width: 150px;">
                            </div>

                            <div class="preview-section">
                                <h5 class="text-primary border-bottom pb-2">Other Details</h5>
                                <p><strong>Nationality:</strong> ${data.nationality || 'N/A'}</p>
                                <p><strong>Religion & Caste:</strong> ${data.religion_caste || 'N/A'}</p>
                                <p><strong>Mother Tongue:</strong> ${data.mother_tongue || 'N/A'}</p>
                                <p><strong>Blood Group:</strong> ${data.blood_group || 'N/A'}</p>
                                <p><strong>Medium of Instruction:</strong> ${data.medium_of_instruction || 'N/A'}</p>
                                <p><strong>Immunization Status:</strong> ${data.immunization_status || 'N/A'}</p>
                            </div>
                        </div>
                    </div>

                    <div class="preview-section">
                        <h5 class="text-primary border-bottom pb-2">Interests and Activities</h5>
                        <p><strong>Hobbies:</strong> ${data.hobbies || 'N/A'}</p>
                        <p><strong>Games/Sports Played:</strong> ${data.games_played || 'N/A'}</p>
                        <p><strong>Co-curricular Achievements:</strong> ${data.cocurricular_achievements || 'N/A'}</p>
                        <p><strong>CCA Options Interested In:</strong> ${data.cca_options || 'N/A'}</p>
                    </div>

                    <div class="preview-section">
                        <h5 class="text-primary border-bottom pb-2">Academic Details</h5>
                        <p><strong>Year of Passing:</strong> ${data.year_of_passing || 'N/A'}</p>
                        <p><strong>Total Marks Obtained:</strong> ${data.total_marks || 'N/A'}</p>
                    </div>

                    <div class="mt-4 border-top pt-3">
                        <p class="text-muted">I hereby declare that all the information provided above is true and correct.</p>
                        <div class="d-flex justify-content-between mt-4">
                            <div>
                                <p class="border-top pt-2">Parent/Guardian Signature</p>
                            </div>
                            <div>
                                <p class="border-top pt-2">Date</p>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        function printPreview() {
            const printContent = document.getElementById('preview-content').innerHTML;
            const originalContent = document.body.innerHTML;
            
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
            
            // Reinitialize modal after print
            const previewModal = new bootstrap.Modal(document.getElementById('previewModal'));
            previewModal.show();
        }

        // Form submission handler
        document.getElementById('admissionForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('submit-btn');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...';
            return true;
        });
    </script>

    <style>
        /* Responsive adjustments */
        .form-label {
            font-size: 0.9rem;
            margin-bottom: 0.3rem;
        }

        .form-control,
        .form-select {
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
        }

        .preview-section {
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }

        .preview-section:last-child {
            border-bottom: none;
        }

        @media (max-width: 767.98px) {
            .card {
                padding: 1.25rem !important;
            }

            h5 {
                margin-top: 1.5rem !important;
            }

            .btn {
                font-size: 0.95rem;
                padding: 0.6rem;
            }
        }
    </style>
@endsection