@extends('layouts.admin')

@section('title', isset($news) ? 'Edit News' : 'Add News')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-primary text-center">{{ isset($news) ? 'Edit News Item' : 'Add News Item' }}</h2>

    <form action="{{ isset($news) ? route('news.update', $news->id) : route('news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($news)) @method('PUT') @endif

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" value="{{ old('title', $news->title ?? '') }}" class="form-control" required placeholder="Title">
        </div>

        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" class="form-control" rows="5" required>{{ old('content', $news->content ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
            @if(isset($news) && $news->image)
                <img src="{{ $news->image }}" class="img-thumbnail mt-2" style="max-height: 100px;">
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">YouTube Link (optional)</label>
            <input type="url" name="youtube_link" value="{{ old('youtube_link', $news->youtube_link ?? '') }}" class="form-control" placeholder="https://youtube.com/watch?v=...">
        </div>

        <button class="btn btn-primary w-100">{{ isset($news) ? 'Update' : 'Create' }}</button>
    </form>
</div>
@endsection
