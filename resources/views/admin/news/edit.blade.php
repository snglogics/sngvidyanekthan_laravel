@extends('layouts.admin')

@section('title', 'Edit News')
@section('breadcrumb-title', 'Edit News')
@section('breadcrumb-link', route('news.index'))

@section('styles')
<style>
    .form-label i {
        color: #6c757d;
        margin-right: 5px;
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    .btn-success {
        font-weight: 600;
        font-size: 1rem;
    }

    .img-thumbnail {
        border-radius: 0.5rem;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

@endsection

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-primary text-center">
        <i class="fas fa-edit"></i> Edit News Item
    </h2>

    <form id="edit-news-form" action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data" class="p-4 shadow-sm bg-white rounded">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label"><i class="fas fa-heading"></i> Title</label>
            <input name="title" value="{{ old('title', $news->title) }}" class="form-control" required placeholder="Enter the news title">
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="fas fa-align-left"></i> Content</label>
            <textarea name="content" class="form-control" rows="5" required placeholder="Write news content...">{{ old('content', $news->content) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="fas fa-image"></i> Current Image</label><br>
            @if($news->image_url)
                <img src="{{ $news->image_url }}" class="img-thumbnail mb-2" style="max-height: 120px;">
            @else
                <p class="text-muted fst-italic">No image uploaded.</p>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="fas fa-upload"></i> Change Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="fab fa-youtube"></i> YouTube Link (optional)</label>
            <input type="url" name="youtube_link" value="{{ old('youtube_link', $news->youtube_link) }}" class="form-control" placeholder="https://youtube.com/watch?v=...">
        </div>

        <button type="submit" class="btn btn-success w-100" id="update-btn">
            <i class="fas fa-save me-1"></i> Update News
            <span id="update-spinner" class="spinner-border spinner-border-sm d-none ms-2" role="status" aria-hidden="true"></span>
        </button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('edit-news-form').addEventListener('submit', function () {
        const btn = document.getElementById('update-btn');
        const spinner = document.getElementById('update-spinner');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Updating...';
        spinner.classList.remove('d-none');
    });
</script>
@endsection
