@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Add Kindergarten Slider</h2>

    <!-- Show List Button -->
    <div class="mb-3">
        <a href="{{ route('admin.kinder-sliders.index') }}" class="btn btn-secondary">Show List</a>
    </div>

    <form id="uploadForm" action="{{ route('admin.kinder-sliders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Header</label>
            <input type="text" name="header" class="form-control">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <button id="submitBtn" class="btn btn-primary" type="submit">Upload</button>
    </form>
</div>

<!-- JavaScript to change button label -->
<script>
    document.getElementById('uploadForm').addEventListener('submit', function () {
        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.innerText = 'Uploading...';
    });
</script>
@endsection
