@extends('layouts.admin')

@section('title', 'Create Live Class')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container py-4">
    <h2 class="text-center text-primary mb-4">Create Live Class</h2>

    <form id="createForm" action="{{ route('live-classes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Platform</label>
            <select name="platform" class="form-control" required>
                <option value="Zoom" {{ old('platform') == 'Zoom' ? 'selected' : '' }}>Zoom</option>
                <option value="Google Meet" {{ old('platform') == 'Google Meet' ? 'selected' : '' }}>Google Meet</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Meeting Link</label>
            <input type="url" name="link" class="form-control" value="{{ old('link') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Scheduled At</label>
            <input type="datetime-local" name="scheduled_at" class="form-control"
                   value="{{ old('scheduled_at', now()->format('Y-m-d\TH:i')) }}" required>
        </div>

        <button type="submit" class="btn btn-primary w-100" id="submitBtn">
            Create
        </button>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    const form = document.getElementById('createForm');
    const submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', () => {
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Creating...
        `;
    });

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}", "Validation Error");
        @endforeach
    @endif

    @if (session('success'))
        toastr.success("{{ session('success') }}", "Success");
    @elseif (session('error'))
        toastr.error("{{ session('error') }}", "Error");
    @endif
</script>
@endsection
