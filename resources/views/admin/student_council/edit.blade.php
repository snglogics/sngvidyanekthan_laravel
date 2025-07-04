@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm mx-auto" style="max-width: 600px;">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Student Council Member</h5>
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

                <form action="{{ route('admin.student_council.update', $studentCouncil->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Student Name <span class="text-danger">*</span></label>
                        <input type="text" name="student_name"
                            value="{{ old('student_name', $studentCouncil->student_name) }}"
                            class="form-control @error('student_name') is-invalid @enderror" required>
                        @error('student_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Position <span class="text-danger">*</span></label>
                        <input type="text" name="position" value="{{ old('position', $studentCouncil->position) }}"
                            class="form-control @error('position') is-invalid @enderror" required>
                        @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Photo</label>
                        @if ($studentCouncil->photo)
                            <div class="mb-2">
                                <img src="{{ $studentCouncil->photo }}" alt="{{ $studentCouncil->student_name }}"
                                    class="img-thumbnail" style="max-width: 150px;">
                            </div>
                        @endif
                        <input type="file" name="photo" accept="image/*"
                            class="form-control @error('photo') is-invalid @enderror">
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Leave blank to keep the current photo.</div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Update Member
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
