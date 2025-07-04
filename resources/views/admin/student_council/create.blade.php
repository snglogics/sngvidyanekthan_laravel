@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm mx-auto" style="max-width: 600px;">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Add Student Council Member</h5>
                <a href="{{ route('admin.student_council.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.student_council.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Student Name <span class="text-danger">*</span></label>
                        <input type="text" name="student_name" value="{{ old('student_name') }}"
                            class="form-control @error('student_name') is-invalid @enderror" required>
                        @error('student_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Position <span class="text-danger">*</span></label>
                        <input type="text" name="position" value="{{ old('position') }}"
                            class="form-control @error('position') is-invalid @enderror" required>
                        @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Photo</label>
                        <input type="file" name="photo" accept="image/*"
                            class="form-control @error('photo') is-invalid @enderror">
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-plus-lg"></i> Add Member
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
