@extends('layouts.layout')

@section('content')
    <div class="container py-5">
        <div class="card shadow-lg p-5">
            <div class="text-center mb-5">
                <h5 class="text-uppercase fw-bold mb-1" style="font-size: 18px;">"One Caste One Religion One God for Man"</h5>
                <h2 class="fw-bold text-primary mb-1">SREENARAYANA VIDYANIKETAN</h2>
                <h5 class="text-uppercase">Student Admission Form</h5>
                <p>(Managed by Sree Narayana Dharma Mangalam Trust, Singall Medu, Vatakara)</p>
                <h4 class="fw-bold text-decoration-underline">Application for Admission</h4>
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

            <form action="{{ route('admissions.submit') }}" method="POST" enctype="multipart/form-data" id="admissionForm">
                @csrf

                {{-- Photo Upload --}}
                <div class="text-end mb-4">
                    <label for="headerPhotoInput" class="d-block" style="cursor: pointer;">
                        <img id="headerPhotoPreview" src="https://via.placeholder.com/120x140?text=Photo" alt="Upload Photo"
                            style="width: 120px; height: 140px; border: 2px solid #000; background-color: #f8f8f8; object-fit: cover;">
                        <input type="file" id="headerPhotoInput" name="photo" accept="image/*"
                            onchange="previewHeaderPhoto(event)" style="display: none;" required>
                    </label>
                    <small class="text-muted">Click to upload passport size photo</small>
                </div>

                {{-- Basic Details --}}
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Class to which admission is sought</label>
                        <input type="text" name="admission_class" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Pupil's Name (in block letters)</label>
                        <input type="text" name="pupil_name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-control" required>
                            <option value="">Select</option>
                            <option value="Boy">Boy</option>
                            <option value="Girl">Girl</option>
                            <option value="Transgender">Transgender</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Aadhaar No.</label>
                        <input type="text" name="aadhaar_no" class="form-control" required>
                    </div>
                </div>

                {{-- Parent Details --}}
                <h5 class="mt-5 text-primary">Parent's Details</h5>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Father's Name</label>
                        <input type="text" name="father_name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Father's Occupation</label>
                        <input type="text" name="father_occupation" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Mother's Name</label>
                        <input type="text" name="mother_name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Mother's Occupation</label>
                        <input type="text" name="mother_occupation" class="form-control">
                    </div>
                </div>

                {{-- Contact Details --}}
                <h5 class="mt-5 text-primary">Contact Details</h5>
                <div class="row g-4">
                    <div class="col-md-4">
                        <label class="form-label">Phone No.</label>
                        <input type="text" name="phone_number" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Whatsapp No.</label>
                        <input type="text" name="whatsapp_number" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                </div>

                {{-- Address Details --}}
                <div class="mt-4">
                    <label class="form-label">Address for Communication</label>
                    <textarea name="address" class="form-control" rows="3" required></textarea>
                </div>

                {{-- Other Details --}}
                <h5 class="mt-5 text-primary">Other Details</h5>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Nationality</label>
                        <input type="text" name="nationality" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Religion & Caste (Optional)</label>
                        <input type="text" name="religion_caste" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Mother Tongue</label>
                        <input type="text" name="mother_tongue" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Blood Group</label>
                        <input type="text" name="blood_group" class="form-control">
                    </div>
                </div>

                <button type="submit" id="submit-btn" class="btn btn-primary w-100 mt-4">Submit Application</button>
            </form>
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
    </script>
@section('scripts')
    <script>
        document.querySelector('form').addEventListener('submit', function() {
            const btn = document.getElementById('submit-btn');
            btn.disabled = true; // prevent multiple clicks
            btn.innerHTML = 'Submitting...';
        });
    </script>
@endsection
@endsection
