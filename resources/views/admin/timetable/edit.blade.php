@extends('layouts.admin')

@section('title', 'Edit Timetable')
@section('breadcrumb-title', 'Academics')
@section('breadcrumb-link', route('admin.academics'))

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        input.form-control,
        select.form-select {
            border-radius: 0.5rem;
        }

        label.form-label i {
            color: #0d6efd;
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">
        <h2 class="mb-4 text-center text-primary"><i class="fas fa-calendar-edit me-2"></i>Edit Timetable PDF</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li><i class="fas fa-exclamation-circle text-danger me-1"></i>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="editForm" action="{{ route('admin.timetables.update', $timetable->id) }}" method="POST"
            enctype="multipart/form-data" class="shadow p-4 rounded bg-light">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Class Name <i class="fas fa-school ms-1"></i></label>
                <input type="text" name="classname" class="form-control"
                    value="{{ old('classname', $timetable->classname) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Current PDF <i class="fas fa-file-pdf ms-1 text-danger"></i></label><br>
                <a href="{{ $timetable->pdf_url }}" target="_blank" class="text-decoration-underline">
                    View Existing Timetable
                </a>
            </div>

            <div class="mb-3">
                <label class="form-label">Replace with New PDF <i class="fas fa-upload ms-1"></i></label>
                <input type="file" name="timetable_pdf" accept="application/pdf" class="form-control">
                <small class="text-muted">Leave blank if you don't want to replace the existing PDF.</small>
            </div>

            <button type="submit" class="btn btn-success w-100 mt-3" id="submitBtn">
                <i class="fas fa-save me-2"></i> Update Timetable
            </button>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        const form = document.getElementById('editForm');
        const submitBtn = document.getElementById('submitBtn');

        form.addEventListener('submit', () => {
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Updating...
        `;
        });

        @if (session('success'))
            toastr.success("{{ session('success') }}", "Success");
        @elseif (session('error'))
            toastr.error("{{ session('error') }}", "Error");
        @endif
    </script>
@endsection
