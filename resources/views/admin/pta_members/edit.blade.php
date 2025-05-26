@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit PTA Member</h2>

    <form id="updateForm" action="{{ route('admin.pta-members.update', $ptaMember->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $ptaMember->name }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Position</label>
            <input type="text" name="position" class="form-control" value="{{ $ptaMember->position }}" required>
            @error('position') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Current Image</label><br>
            <img src="{{ $ptaMember->image_url }}" height="80" width="80" style="object-fit:cover; border-radius:50%">
        </div>

        <div class="mb-3">
            <label>Replace Image (Optional)</label>
            <input type="file" name="image" class="form-control">
            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button id="submitBtn" type="submit" class="btn btn-primary">
            🔄 Update
        </button>
        <a href="{{ route('admin.pta-members.index') }}" class="btn btn-secondary">↩️ Back</a>
    </form>
</div>

{{-- Add script to handle button label update --}}
@section('scripts')
<script>
    document.getElementById('updateForm').addEventListener('submit', function () {
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...';
    });
</script>
@endsection
@endsection
