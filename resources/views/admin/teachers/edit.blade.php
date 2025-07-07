@extends('layouts.admin')

@section('styles')
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Teacher</h4>
                <a href="{{ route('admin.teachers.index') }}" class="btn btn-light btn-sm">
                    <i class="bi bi-arrow-left-circle"></i> Back to List
                </a>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <h5><i class="bi bi-exclamation-triangle-fill me-2"></i> Please fix the following issues:</h5>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.teachers.update', $teacher->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                <input type="text" name="name" value="{{ old('name', $teacher->name) }}"
                                    class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="designation" class="form-label">Designation <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-briefcase-fill"></i></span>
                                <input type="text" name="designation"
                                    value="{{ old('designation', $teacher->designation) }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="experience" class="form-label">Experience (Years) <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-clock-fill"></i></span>
                                <input type="number" name="experience"
                                    value="{{ old('experience', $teacher->experience) }}" class="form-control"
                                    min="0">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="qualification" class="form-label">Qualification</label>
                            <input type="text" name="qualification"
                                value="{{ old('qualification', $teacher->qualification) }}" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="department" class="form-label">Department</label>
                            <input type="text" name="department" value="{{ old('department', $teacher->department) }}"
                                class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" name="subject" value="{{ old('subject', $teacher->subject) }}"
                                class="form-control">
                        </div>

                        <div class="col-12 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4">{{ old('description', $teacher->description) }}</textarea>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="photo" class="form-label">Photo</label>
                            @if ($teacher->photo)
                                <div class="mb-2">
                                    <img src="{{ $teacher->photo }}" alt="Teacher Photo" class="img-thumbnail shadow-sm"
                                        width="150">
                                </div>
                            @endif
                            <input type="file" name="photo" class="form-control">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle me-1"></i> Update Teacher
                        </button>
                        <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle me-1"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
