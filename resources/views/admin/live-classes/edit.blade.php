@extends('layouts.admin')

@section('title', 'Edit Live Class')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="container py-4">
    <h2 class="text-center text-primary mb-4">Edit Live Class</h2>

    <form action="{{ route('admin.live-classes.update', $liveClass->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $liveClass->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $liveClass->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Platform</label>
            <select name="platform" class="form-control" required>
                <option value="Zoom" {{ old('platform', $liveClass->platform) == 'Zoom' ? 'selected' : '' }}>Zoom</option>
                <option value="Google Meet" {{ old('platform', $liveClass->platform) == 'Google Meet' ? 'selected' : '' }}>Google Meet</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Meeting Link</label>
            <input type="url" name="link" class="form-control" value="{{ old('link', $liveClass->link) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Scheduled At</label>
            <input type="datetime-local" name="scheduled_at" class="form-control"
                   value="{{ old('scheduled_at', \Carbon\Carbon::parse($liveClass->scheduled_at)->format('Y-m-d\TH:i')) }}" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Update</button>
    </form>
</div>
<script>
    @if (session('success'))
    toastr.success("{{ session('success') }}");
@endif
</script>
@endsection
