@extends('layouts.admin')

@section('title', 'Edit Live Class')
@section('breadcrumb-title', 'Faculty')
@section('breadcrumb-link', route('admin.faculties'))

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container py-4">
    <div class="card shadow rounded">
        <div class="card-header bg-primary text-white text-center">
            <h4><i class="bi bi-pencil-square me-2"></i>Edit Live Class</h4>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.live-classes.update', $liveClass->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-type me-1"></i>Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter class title"
                           value="{{ old('title', $liveClass->title) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-card-text me-1"></i>Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Enter description">{{ old('description', $liveClass->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-camera-video me-1"></i>Platform</label>
                    <select name="platform" class="form-select" required>
                        <option value="Zoom" {{ old('platform', $liveClass->platform) == 'Zoom' ? 'selected' : '' }}>Zoom</option>
                        <option value="Google Meet" {{ old('platform', $liveClass->platform) == 'Google Meet' ? 'selected' : '' }}>Google Meet</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-link-45deg me-1"></i>Meeting Link</label>
                    <input type="url" name="link" class="form-control" placeholder="Paste meeting URL"
                           value="{{ old('link', $liveClass->link) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-calendar-event me-1"></i>Scheduled At</label>
                    <input type="datetime-local" name="scheduled_at" class="form-control"
                           value="{{ old('scheduled_at', \Carbon\Carbon::parse($liveClass->scheduled_at)->format('Y-m-d\TH:i')) }}" required>
                </div>

                <button type="submit" class="btn btn-success w-100">
                    <i class="bi bi-save me-1"></i>Update Class
                </button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @endif
</script>
@endsection
