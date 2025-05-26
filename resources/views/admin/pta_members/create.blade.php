@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Add PTA Member</h2>

    <form id="createForm" action="{{ route('admin.pta-members.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Position</label>
            <input type="text" name="position" class="form-control" required>
            @error('position') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control" required>
            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button id="submitBtn" type="submit" class="btn btn-success">
            💾 Save
        </button>
        <a href="{{ route('admin.pta-members.index') }}" class="btn btn-secondary">↩️ Back</a>
    </form>
</div>

{{-- Button label script --}}
@section('scripts')
<script>
    document.getElementById('createForm').addEventListener('submit', function () {
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...';
    });
</script>
@endsection
@endsection
