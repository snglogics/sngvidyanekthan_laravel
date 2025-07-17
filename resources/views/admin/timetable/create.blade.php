@extends('layouts.admin')

@section('title', 'Create Timetable')
@section('breadcrumb-title', 'Academics')
@section('breadcrumb-link', route('admin.academics'))

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection

@section('content')
    <div class="container py-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex align-items-center">
                <i class="fas fa-calendar-alt me-2"></i>
                <h5 class="mb-0">Add New Timetable Entry</h5>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li><i class="fas fa-exclamation-circle me-1"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="timetableForm" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="classname" class="form-label"><i class="fas fa-school me-1"></i> Class</label>
                        <input type="text" name="classname" class="form-control" placeholder="e.g. 10th Grade" required>
                    </div>

                    <div class="mb-3">
                        <label for="timetable_pdf" class="form-label"><i class="fas fa-file-pdf me-1"></i> Upload Timetable
                            PDF</label>
                        <input type="file" name="timetable_pdf" accept="application/pdf" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100" id="submitBtn">
                        <i class="fas fa-upload me-1"></i> Upload PDF
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        const form = document.getElementById('timetableForm');
        const submitBtn = document.getElementById('submitBtn');

        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            submitBtn.disabled = true;
            submitBtn.innerHTML =
                `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...`;

            const formData = new FormData(form);

            try {
                const response = await fetch("{{ route('admin.timetables.store') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: formData
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    toastr.success(result.message || "Saved successfully.");
                    setTimeout(() => {
                        window.location.href = result.redirect ||
                            "{{ route('admin.timetables.index') }}";
                    }, 1000);
                } else if (response.status === 422) {
                    let errors = result.errors;
                    Object.values(errors).forEach(errArr => {
                        errArr.forEach(err => toastr.error(err, "Validation Error"));
                    });
                } else {
                    toastr.error(result.message || "Something went wrong.");
                }
            } catch (err) {
                toastr.error("Unexpected error occurred.");
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = `<i class="fas fa-save me-1"></i> Save Timetable`;
            }
        });
    </script>
@endsection
