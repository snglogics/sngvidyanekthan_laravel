@extends('layouts.layout')

@section('content')
    <div class="container py-5">
        <div class="card shadow p-4">
            <div class="position-relative d-flex justify-content-between align-items-start mb-4">
                <div class="text-center flex-grow-1 pe-4">
                    <h5 class="text-uppercase fw-bold mb-1" style="font-size: 18px;">"One Caste One Religion One God for Man"
                    </h5>
                    <h3 class="fw-bold text-primary mb-1">SREENARAYANA VIDYANIKETAN</h3>
                    <h5 class="text-uppercase">Kindergarten</h5>
                    <p>(Managed by Sree Narayana Dharma Mangalam Trust, Singall Medu, Vatakara)</p>
                    <h4 class="fw-bold text-decoration-underline">Application for Admission</h4>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                <script>
                    alert("{{ session('success') }}");
                </script>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('student.submit') }}" id="admissionForm" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Photo Upload --}}
                <div class="mb-3 text-end">
                    <div
                        style="width: 120px; height: 140px; border: 2px solid #000; background-color: #f8f8f8; float: right;">
                        <label for="headerPhotoInput" style="cursor: pointer; display: block; width: 100%; height: 100%;">
                            <img id="headerPhotoPreview" src="https://via.placeholder.com/120x140?text=Photo"
                                alt="Upload Photo" style="width: 100%; height: 100%; object-fit: cover;">
                            <input type="file" id="headerPhotoInput" name="photo" accept="image/*"
                                onchange="previewHeaderPhoto(event)" style="display: none;">
                        </label>
                    </div>
                </div>

                {{-- Form Fields --}}
                <div class="row mb-3 mt-2">
                    <div class="col-md-6">
                        <label class="form-label">1. Class to which admission is sought (LKG/UKG)</label>
                        <input name="class" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">2. Student's Name (in block letters)</label>
                        <input name="pupil_name" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">3. Gender</label>
                        <select name="gender" class="form-control" required>
                            <option value="">Select</option>
                            <option value="Boy">Boy</option>
                            <option value="Girl">Girl</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">4. Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control" required>
                    </div>
                </div>

                <h5 class="mt-4 text-primary">Parent's Details</h5>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">5 (a). Name of Father</label>
                        <input name="father_name" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">5 (b) Occupation</label>
                        <input name="father_occupation" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">6 (a). Name of Mother</label>
                        <input name="mother_name" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">6 (b). Occupation</label>
                        <input name="mother_occupation" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">7. Address for Communication</label>
                    <textarea name="address" class="form-control" rows="3" required></textarea>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">8. Mobile No.</label>
                        <input name="mobile_number" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">9. Whatsapp No.</label>
                        <input name="Whatsapp_number" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">10. Aadhar No. of Ward</label>
                        <input name="aadhar" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">11. E-mail</label>
                        <input name="email" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">12. Annual Income of Parents</label>
                        <input name="annual_income" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">13. Nationality</label>
                        <input name="nationality" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">14. Religion & Caste (Optional)</label>
                        <input name="religion" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">15. Mother Tongue</label>
                        <input name="mother_toungue" class="form-control">
                    </div>
                </div>

                <h5 class="mt-4 text-primary">16 (a) Parent's Education Details</h5>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">(a). Father</label>
                        <input name="father_education" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">(b). Mother</label>
                        <input name="mother_education" class="form-control">
                    </div>
                </div>

                <h5 class="mt-4 text-primary">16 (b) Other Details</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">17. Total Members of the Family</label>
                        <input name="total_members" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">18. Name & Class of brother/sister already in this School/ Main
                            School</label>
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
                        <input name="blood_group" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">22. Boarding Point</label>
                        <input name="boarding_point" class="form-control">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Submit Application</button>
            </form>
        </div>
    </div>

    <script>
        function previewHeaderPhoto(event) {
            const input = event.target;
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('headerPhotoPreview').src = reader.result;
            }
            if (input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
