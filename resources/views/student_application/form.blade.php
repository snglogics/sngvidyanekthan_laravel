@extends('layouts.layout')

@section('content')
<style>
    #photoError, #declarationError {
    display: none;
}

.is-invalid ~ .invalid-feedback,
.is-invalid ~ div > .invalid-feedback {
    display: block;
}

.form-check-input.is-invalid ~ .form-check-label,
.form-check-input.is-invalid ~ .invalid-feedback {
    color: #dc3545;
}

.form-check-input.is-invalid {
    border-color: #dc3545;
}
    </style>
    <div class="container py-5">
        <div class="card shadow p-4">
            <div class="position-relative d-flex justify-content-between align-items-start mb-4">
                <div class="text-center flex-grow-1 pe-4">
                    <h5 class="text-uppercase fw-bold mb-1" style="font-size: 18px;">"One Caste One Religion One God for Man"</h5>
                    <h3 class="fw-bold text-primary mb-1">SREENARAYANA VIDYA NIKETAN</h3>
                    <h5 class="text-uppercase">Kindergarten</h5>
                    <p>(Managed by Sree Narayana Dharma Mangalam Trust, Singall Medu, Vatakara)</p>
                    <h4 class="fw-bold text-decoration-underline">Application for Admission</h4>
                </div>
            </div>

           @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <script>
        // Ensure the alert stays visible after page load
        document.addEventListener('DOMContentLoaded', function() {
            // Scroll to the alert if it exists
            const alert = document.querySelector('.alert-success');
            if (alert) {
                alert.scrollIntoView({ behavior: 'smooth' });
            }
        });
    </script>
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

            <form action="{{ route('student.submit') }}" id="admissionForm" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf

                <!-- Form Navigation Tabs -->
                <ul class="nav nav-tabs mb-4" id="formTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic" type="button" role="tab">Basic Info</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="parents-tab" data-bs-toggle="tab" data-bs-target="#parents" type="button" role="tab">Parents Info</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="additional-tab" data-bs-toggle="tab" data-bs-target="#additional" type="button" role="tab">Additional Info</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="preview-tab" data-bs-toggle="tab" data-bs-target="#preview" type="button" role="tab">Preview</button>
                    </li>
                </ul>

                <div class="tab-content" id="formTabsContent">
                    <!-- Basic Info Tab -->
                    <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                       
                       <!-- Photo Upload -->
<div class="mb-3 text-end">
    <div class="photo-upload-container" style="width: 120px; height: 140px; border: 2px solid #000; background-color: #f8f8f8; float: right;">
        <label for="headerPhotoInput" style="cursor: pointer; display: block; width: 100%; height: 100%;">
            <img id="headerPhotoPreview" src="https://via.placeholder.com/120x140?text=Photo" 
                 alt="Upload Photo" style="width: 100%; height: 100%; object-fit: cover;">
            <input type="file" id="headerPhotoInput" name="photo" accept="image/*" 
                   onchange="previewHeaderPhoto(event)" style="display: none;" required>
        </label>
    </div>
    <div id="photoError" class="invalid-feedback d-block text-end">* Please upload a student photo</div>
</div>

                        <!-- Student Basic Info -->
                        <div class="row mb-3 mt-2">
                            <div class="col-md-6">
                                <label class="form-label">1. Class to which admission is sought (LKG/UKG)</label>
                                <input name="class" class="form-control" required pattern="LKG|UKG|lkg|ukg">
                                <div class="invalid-feedback">Please enter LKG or UKG</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">2. Student's Name (in block letters)</label>
                                <input name="pupil_name" class="form-control" required pattern="[A-Z\s]+">
                                <div class="invalid-feedback">Please enter name in block letters</div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">3. Gender</label>
                                <select name="gender" class="form-control" required>
                                    <option value="" selected disabled>Select Gender</option>
                                    <option value="Boy">Boy</option>
                                    <option value="Girl">Girl</option>
                                </select>
                                <div class="invalid-feedback">Please select gender</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">4. Date of Birth</label>
                                <input type="date" name="date_of_birth" class="form-control" required 
                                       max="{{ date('Y-m-d', strtotime('-3 years')) }}" 
                                       min="{{ date('Y-m-d', strtotime('-6 years')) }}">
                                <div class="invalid-feedback">Please select valid date of birth (3-6 years old)</div>
                            </div>
                        </div>
                    </div>

                    <!-- Parents Info Tab -->
                    <div class="tab-pane fade" id="parents" role="tabpanel" aria-labelledby="parents-tab">
                        <h5 class="mt-2 text-primary">Parent's Details</h5>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label">5 (a). Name of Father</label>
                                <input name="father_name" class="form-control" required>
                                <div class="invalid-feedback">Father's name is required</div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">5 (b) Occupation</label>
                                <input name="father_occupation" class="form-control" required>
                                <div class="invalid-feedback">Father's occupation is required</div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">6 (a). Name of Mother</label>
                                <input name="mother_name" class="form-control" required>
                                <div class="invalid-feedback">Mother's name is required</div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">6 (b). Occupation</label>
                                <input name="mother_occupation" class="form-control" required>
                                <div class="invalid-feedback">Mother's occupation is required</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">7. Address for Communication</label>
                            <textarea name="address" class="form-control" rows="3" required></textarea>
                            <div class="invalid-feedback">Please provide address</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">8. Mobile No.</label>
                                <input name="mobile_number" class="form-control" required pattern="[0-9]{10}">
                                <div class="invalid-feedback">Please enter 10 digit mobile number</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">9. Whatsapp No.</label>
                                <input name="Whatsapp_number" class="form-control" required pattern="[0-9]{10}">
                                <div class="invalid-feedback">Please enter 10 digit WhatsApp number</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">10. Aadhar No. of Student</label>
                                <input name="aadhar" class="form-control" required pattern="^[2-9]{1}[0-9]{11}$">
                                <div class="invalid-feedback">Please enter valid 12 digit Aadhar number</div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Info Tab -->
                    <div class="tab-pane fade" id="additional" role="tabpanel" aria-labelledby="additional-tab">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">11. E-mail</label>
                                <input type="email" name="email" class="form-control" required>
                                <div class="invalid-feedback">Please enter valid email</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">12. Annual Income of Parents</label>
                                <input name="annual_income" class="form-control" pattern="[0-9]+">
                                <div class="invalid-feedback">Please enter numbers only</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">13. Nationality</label>
                                <input name="nationality" class="form-control" value="Indian" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">14. Religion & Caste (Optional)</label>
                                <input name="religion" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">15. Mother Tongue</label>
                                <select name="mother_toungue" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Malayalam">Malayalam</option>
                                    <option value="Hindi">Hindi</option>
                                    <option value="English">English</option>
                                    <option value="Tamil">Tamil</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>

                        <h5 class="mt-4 text-primary">16 (a) Parent's Education Details</h5>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">(a). Father</label>
                                <select name="father_education" class="form-control">
                                    <option value="">Select Education</option>
                                    <option value="Below 10th">Below 10th</option>
                                    <option value="10th Pass">10th Pass</option>
                                    <option value="12th Pass">12th Pass</option>
                                    <option value="Graduate">Graduate</option>
                                    <option value="Post Graduate">Post Graduate</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">(b). Mother</label>
                                <select name="mother_education" class="form-control">
                                    <option value="">Select Education</option>
                                    <option value="Below 10th">Below 10th</option>
                                    <option value="10th Pass">10th Pass</option>
                                    <option value="12th Pass">12th Pass</option>
                                    <option value="Graduate">Graduate</option>
                                    <option value="Post Graduate">Post Graduate</option>
                                </select>
                            </div>
                        </div>

                        <h5 class="mt-4 text-primary">16 (b) Other Details</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">17. Total Members of the Family</label>
                                <input type="number" name="total_members" class="form-control" min="1">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">18. Name & Class of brother/sister already in this School/ Main School</label>
                                <input name="siblings" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">19. Name of local Guardian with phone number</label>
                                <input name="local_guardian" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">20. Hobbies</label>
                                <input name="hobbies" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">21. Blood Group</label>
                                <select name="blood_group" class="form-control">
                                    <option value="">Select</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">22. Boarding Point</label>
                                <input name="boarding_point" class="form-control">
                            </div>
                        </div>
                    </div>

                    <!-- Preview Tab -->
                    <div class="tab-pane fade" id="preview" role="tabpanel" aria-labelledby="preview-tab">
                        <div class="preview-container p-4 border rounded">
                            <h4 class="text-center mb-4">Application Preview</h4>
                            
                            <div class="row mb-4">
                                <div class="col-md-3 text-center">
                                    <img id="previewPhoto" src="https://via.placeholder.com/120x140?text=Photo" 
                                         alt="Student Photo" class="img-thumbnail" style="width: 120px; height: 140px;">
                                </div>
                                <div class="col-md-9">
                                    <h5 id="previewPupilName" class="fw-bold"></h5>
                                    <p><strong>Class:</strong> <span id="previewClass"></span></p>
                                    <p><strong>DOB:</strong> <span id="previewDob"></span></p>
                                    <p><strong>Gender:</strong> <span id="previewGender"></span></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="text-primary">Parents Information</h5>
                                    <p><strong>Father:</strong> <span id="previewFatherName"></span></p>
                                    <p><strong>Occupation:</strong> <span id="previewFatherOccupation"></span></p>
                                    <p><strong>Education:</strong> <span id="previewFatherEducation"></span></p>
                                    
                                    <p><strong>Mother:</strong> <span id="previewMotherName"></span></p>
                                    <p><strong>Occupation:</strong> <span id="previewMotherOccupation"></span></p>
                                    <p><strong>Education:</strong> <span id="previewMotherEducation"></span></p>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="text-primary">Contact Information</h5>
                                    <p><strong>Address:</strong> <span id="previewAddress"></span></p>
                                    <p><strong>Mobile:</strong> <span id="previewMobile"></span></p>
                                    <p><strong>WhatsApp:</strong> <span id="previewWhatsapp"></span></p>
                                    <p><strong>Email:</strong> <span id="previewEmail"></span></p>
                                    <p><strong>Aadhar:</strong> <span id="previewAadhar"></span></p>
                                </div>
                            </div>

                            <div class="mt-4">
                                <h5 class="text-primary">Additional Information</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Mother Tongue:</strong> <span id="previewMotherTongue"></span></p>
                                        <p><strong>Religion:</strong> <span id="previewReligion"></span></p>
                                        <p><strong>Blood Group:</strong> <span id="previewBloodGroup"></span></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Family Members:</strong> <span id="previewFamilyMembers"></span></p>
                                        <p><strong>Siblings:</strong> <span id="previewSiblings"></span></p>
                                        <p><strong>Hobbies:</strong> <span id="previewHobbies"></span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-check mt-4">
    <input class="form-check-input" type="checkbox" id="declarationCheck" name="declaration" required>
    <label class="form-check-label" for="declarationCheck">
        I declare that all the information provided is correct to the best of my knowledge.
    </label>
    <div id="declarationError" class="invalid-feedback">You must accept the declaration</div>
</div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary" id="prevBtn" disabled>Previous</button>
                    <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
                    <button type="submit" class="btn btn-success" id="submitBtn" style="display: none;">Submit Application</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for Form Submission -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Submission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to submit the application? Please verify all details before submission.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Review Again</button>
                    <button type="button" class="btn btn-primary" id="confirmSubmit">Yes, Submit</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Form Tab Navigation
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('admissionForm');
            const tabs = document.querySelectorAll('.nav-tabs .nav-link');
            const tabPanes = document.querySelectorAll('.tab-pane');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const submitBtn = document.getElementById('submitBtn');
            let currentTab = 0;

            // Show the current tab
            function showTab(n) {
                tabs[n].classList.add('active');
                tabPanes[n].classList.add('show', 'active');
                
                // Update button visibility
                if (n === 0) {
                    prevBtn.disabled = true;
                    nextBtn.style.display = 'inline-block';
                    submitBtn.style.display = 'none';
                } else if (n === tabs.length - 1) {
                    prevBtn.disabled = false;
                    nextBtn.style.display = 'none';
                    submitBtn.style.display = 'inline-block';
                    updatePreview();
                } else {
                    prevBtn.disabled = false;
                    nextBtn.style.display = 'inline-block';
                    submitBtn.style.display = 'none';
                }
            }

            // Next/previous button functionality
            function nextPrev(n) {
                // Validate the current tab before proceeding
                if (n === 1 && !validateTab(currentTab)) return false;
                
                // Hide the current tab
                tabs[currentTab].classList.remove('active');
                tabPanes[currentTab].classList.remove('show', 'active');
                
                // Update current tab
                currentTab += n;
                
                // Show the new tab
                showTab(currentTab);
            }

            // Validate tab fields
           // Validate tab fields
function validateTab(n) {
    let valid = true;
    const inputs = tabPanes[n].querySelectorAll('input,select,textarea[required]');
    
    inputs.forEach(input => {
        if (!input.checkValidity()) {
            input.classList.add('is-invalid');
            // Special handling for photo upload
            if (input.id === 'headerPhotoInput') {
                document.getElementById('photoError').style.display = 'block';
            }
            valid = false;
        } else {
            input.classList.remove('is-invalid');
            if (input.id === 'headerPhotoInput') {
                document.getElementById('photoError').style.display = 'none';
            }
        }
    });
    
    // Special handling for declaration checkbox in preview tab
    if (n === 3) { // Preview tab index
        const declarationCheck = document.getElementById('declarationCheck');
        if (!declarationCheck.checked) {
            declarationCheck.classList.add('is-invalid');
            document.getElementById('declarationError').style.display = 'block';
            valid = false;
        } else {
            declarationCheck.classList.remove('is-invalid');
            document.getElementById('declarationError').style.display = 'none';
        }
    }
    
    if (!valid) {
        tabPanes[n].querySelector('.is-invalid').focus();
    }
    
    return valid;
}

// Photo preview function with validation
function previewHeaderPhoto(event) {
    const input = event.target;
    const reader = new FileReader();
    const errorElement = document.getElementById('photoError');
    
    if (input.files && input.files[0]) {
        // Validate file type
        const validTypes = ['image/jpeg', 'image/png'];
        if (!validTypes.includes(input.files[0].type)) {
            errorElement.textContent = 'Only JPG/PNG images are allowed';
            errorElement.style.display = 'block';
            input.value = '';
            return;
        }
        
        // Validate file size (max 2MB)
        if (input.files[0].size > 2 * 1024 * 1024) {
            errorElement.textContent = 'Image size should be less than 2MB';
            errorElement.style.display = 'block';
            input.value = '';
            return;
        }
        
        reader.onload = function() {
            const preview = document.getElementById('headerPhotoPreview');
            preview.src = reader.result;
            preview.classList.add('uploaded-photo');
            errorElement.style.display = 'none';
            input.classList.remove('is-invalid');
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        errorElement.style.display = 'block';
        input.classList.add('is-invalid');
    }
}

            // Update preview with form data
            function updatePreview() {
                // Student Info
                document.getElementById('previewPhoto').src = document.getElementById('headerPhotoPreview').src;
                document.getElementById('previewPupilName').textContent = form.pupil_name.value;
                document.getElementById('previewClass').textContent = form.class.value;
                document.getElementById('previewDob').textContent = new Date(form.date_of_birth.value).toLocaleDateString();
                document.getElementById('previewGender').textContent = form.gender.value;
                
                // Parents Info
                document.getElementById('previewFatherName').textContent = form.father_name.value;
                document.getElementById('previewFatherOccupation').textContent = form.father_occupation.value;
                document.getElementById('previewFatherEducation').textContent = form.father_education.value || 'Not specified';
                document.getElementById('previewMotherName').textContent = form.mother_name.value;
                document.getElementById('previewMotherOccupation').textContent = form.mother_occupation.value;
                document.getElementById('previewMotherEducation').textContent = form.mother_education.value || 'Not specified';
                
                // Contact Info
                document.getElementById('previewAddress').textContent = form.address.value;
                document.getElementById('previewMobile').textContent = form.mobile_number.value;
                document.getElementById('previewWhatsapp').textContent = form.Whatsapp_number.value;
                document.getElementById('previewEmail').textContent = form.email.value;
                document.getElementById('previewAadhar').textContent = form.aadhar.value;
                
                // Additional Info
                document.getElementById('previewMotherTongue').textContent = form.mother_toungue.value || 'Not specified';
                document.getElementById('previewReligion').textContent = form.religion.value || 'Not specified';
                document.getElementById('previewBloodGroup').textContent = form.blood_group.value || 'Not specified';
                document.getElementById('previewFamilyMembers').textContent = form.total_members.value || 'Not specified';
                document.getElementById('previewSiblings').textContent = form.siblings.value || 'None';
                document.getElementById('previewHobbies').textContent = form.hobbies.value || 'Not specified';
            }

            // Event listeners
            prevBtn.addEventListener('click', () => nextPrev(-1));
            nextBtn.addEventListener('click', () => nextPrev(1));
            
            // Submit button shows confirmation modal
            // Submit button shows confirmation modal
submitBtn.addEventListener('click', (e) => {
    e.preventDefault();
    
    // Validate all tabs before submission
    let allValid = true;
    for (let i = 0; i < tabs.length; i++) {
        if (!validateTab(i)) {
            allValid = false;
            // Jump to first invalid tab
            if (currentTab !== i) {
                tabs[currentTab].classList.remove('active');
                tabPanes[currentTab].classList.remove('show', 'active');
                currentTab = i;
                showTab(currentTab);
            }
            break;
        }
    }
    
    if (allValid) {
        const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
        modal.show();
    }
});
            
            // Confirm submission
            document.getElementById('confirmSubmit').addEventListener('click', () => {
                form.submit();
            });
            
            // Initialize first tab
            showTab(0);
        });

        // Photo preview function
        function previewHeaderPhoto(event) {
            const input = event.target;
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('headerPhotoPreview');
                preview.src = reader.result;
                preview.classList.add('uploaded-photo');
            }
            if (input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Client-side validation
        (function() {
            'use strict';
            
            // Fetch all forms with validation
            const forms = document.querySelectorAll('.needs-validation');
            
            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    
                    form.classList.add('was-validated');
                }, false);
            });
        })();

        // Input masking for phone numbers
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile number input
            const mobileInput = document.querySelector('input[name="mobile_number"]');
            mobileInput.addEventListener('input', function(e) {
                this.value = this.value.replace(/[^0-9]/g, '').substring(0, 10);
            });
            
            // WhatsApp number input
            const whatsappInput = document.querySelector('input[name="Whatsapp_number"]');
            whatsappInput.addEventListener('input', function(e) {
                this.value = this.value.replace(/[^0-9]/g, '').substring(0, 10);
            });
            
            // Aadhar number input
            const aadharInput = document.querySelector('input[name="aadhar"]');
            aadharInput.addEventListener('input', function(e) {
                this.value = this.value.replace(/[^0-9]/g, '').substring(0, 12);
            });
        });
    </script>

    <style>
        .photo-upload-container {
            position: relative;
            overflow: hidden;
        }
        .uploaded-photo {
            border: 1px solid #ddd;
        }
        .nav-tabs .nav-link {
            color: #495057;
            font-weight: 500;
        }
        .nav-tabs .nav-link.active {
            color: #0d6efd;
            font-weight: bold;
        }
        .preview-container {
            background-color: #f8f9fa;
        }
        .is-invalid {
            border-color: #dc3545;
        }
        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875em;
        }
        .form-control:disabled, .form-control[readonly] {
            background-color: #e9ecef;
        }
    </style>
@endsection