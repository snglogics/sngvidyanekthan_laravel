@extends('layouts.admin')

@section('title', 'Add Field Trip')
@section('breadcrumb-title', 'Student Life')
@section('breadcrumb-link', route('admin.studentlife'))

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@section('content')
<div class="container py-4">
    <div class="card p-4 shadow-sm rounded-4 border-0">
        <h2 class="text-center mb-4 text-primary">
            <i class="fas fa-bus-school me-2"></i>Add Field Trip
        </h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.field_trips.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-heading me-2"></i>Trip Title
                </label>
                <input type="text" name="title" class="form-control rounded-pill" value="{{ old('title') }}" required>
                @error('title') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-map-marker-alt me-2"></i>Location
                </label>
                <input type="text" name="location" class="form-control rounded-pill" value="{{ old('location') }}" required>
                @error('location') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-calendar-alt me-2"></i>Start Date
                    </label>
                    <input type="date" name="start_date" class="form-control rounded-pill" value="{{ old('start_date') }}" required>
                    @error('start_date') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-calendar-check me-2"></i>End Date
                    </label>
                    <input type="date" name="end_date" class="form-control rounded-pill" value="{{ old('end_date') }}" required>
                    @error('end_date') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-user me-2"></i>Contact Person
                </label>
                <input type="text" name="contact_person" class="form-control rounded-pill" value="{{ old('contact_person') }}" required>
                @error('contact_person') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-phone me-2"></i>Contact Number
                </label>
                <input type="text" name="contact_number" class="form-control rounded-pill" value="{{ old('contact_number') }}" required>
                @error('contact_number') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-align-left me-2"></i>Description
                </label>
                <textarea name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
                @error('description') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">
                    <i class="fas fa-image me-2"></i>Trip Image
                </label>
                <input type="file" name="image" class="form-control" accept="image/*">
                @error('image') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100 rounded-pill">
                <i class="fas fa-plus-circle me-2"></i>Add Field Trip
            </button>
        </form>
    </div>
</div>
@endsection
