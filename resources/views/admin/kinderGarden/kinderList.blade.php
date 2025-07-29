@extends('layouts.admin') 

@section('title', 'Kinder Home')
@section('breadcrumb-title', 'Kinder Gallery List')
@section('content')

<div class="mb-4 d-flex justify-content-between align-items-center">
    <h2>Kinder Gallery Groups</h2>
    <a href="{{ route('admin.kinder.upload.form') }}" class="btn btn-primary">Create New</a>
</div>

@foreach($groupedGalleries as $header => $images)
    <h4>{{ $header }}</h4>

    <!-- Delete All Images by Header -->
    <form method="POST" action="{{ route('admin.kinder.deleteByHeader') }}" style="margin-bottom: 10px;">
        @csrf
        <input type="hidden" name="common_header" value="{{ $header }}">
        <button type="submit" class="btn btn-danger btn-sm">Delete All</button>
    </form>

    <!-- Add More Images to Existing Group -->
    <form method="POST" action="{{ route('admin.kinder.upload') }}" enctype="multipart/form-data" class="add-image-form mb-3">
        @csrf
        <input type="hidden" name="common_header" value="{{ $header }}">
        <div class="d-flex gap-2 align-items-center">
            <input type="file" name="images[]" multiple required class="form-control" style="max-width: 300px;">
            <button type="submit" class="btn btn-success uploader-btn">
                <span class="default-text">Add More Images</span>
                <span class="loading-text d-none">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Uploading...
                </span>
            </button>
        </div>
    </form>

    <!-- Gallery Thumbnails -->
    <div style="display: flex; flex-wrap: wrap;">
        @foreach($images as $image)
            <div style="margin: 10px; text-align: center;">
                <img src="{{ $image->image_url }}" alt="Image" width="150" style="border: 1px solid #ccc; padding: 5px;">
                <form method="POST" action="{{ route('admin.kinder.delete', $image->id) }}" class="mt-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
        @endforeach
    </div>
    <hr>
@endforeach

<!-- JS for button loader -->
@section('scripts')
<script>
    document.querySelectorAll('.add-image-form').forEach(form => {
        form.addEventListener('submit', function() {
            const button = form.querySelector('.uploader-btn');
            button.querySelector('.default-text').classList.add('d-none');
            button.querySelector('.loading-text').classList.remove('d-none');
            button.disabled = true;
        });
    });
</script>
@endsection

@endsection
