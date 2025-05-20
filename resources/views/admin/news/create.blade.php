@extends('layouts.admin')

@section('title', isset($news) ? 'Edit News' : 'Add News')
@section('breadcrumb-title', 'Events')
@section('breadcrumb-link', route('admin.event'))

@section('styles')
<!-- Add Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .spinner-border {
        width: 1.5rem;
        height: 1.5rem;
        vertical-align: middle;
        margin-left: 8px;
    }

    .form-label i {
        margin-right: 6px;
        color: #0d6efd;
    }

    .table td, .table th {
        vertical-align: middle;
    }

    .btn-icon {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .img-preview {
        max-height: 100px;
        border-radius: 8px;
        margin-top: 10px;
    }

    .table th {
        white-space: nowrap;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center text-primary">
        <i class="bi bi-calendar2-event-fill"></i> {{ isset($news) ? 'Edit News Item' : 'Add News Item' }}
    </h2>

    <form id="news-form" action="{{ isset($news) ? route('news.update', $news->id) : route('news.store') }}" method="POST" enctype="multipart/form-data" class="border rounded p-4 shadow-sm bg-light">
        @csrf
        @if(isset($news)) @method('PUT') @endif

        <div class="mb-3">
            <label class="form-label"><i class="bi bi-card-text"></i> Title</label>
            <input name="title" value="{{ old('title', $news->title ?? '') }}" class="form-control" required placeholder="Enter news title">
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="bi bi-body-text"></i> Content</label>
            <textarea name="content" class="form-control" rows="5" required placeholder="Write your content here...">{{ old('content', $news->content ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="bi bi-image"></i> Image</label>
            <input type="file" name="image" class="form-control">
            @if(isset($news) && $news->image_url)
                <img src="{{ $news->image_url }}" class="img-preview">
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="bi bi-youtube"></i> YouTube Link (optional)</label>
            <input type="url" name="youtube_link" value="{{ old('youtube_link', $news->youtube_link ?? '') }}" class="form-control" placeholder="https://youtube.com/watch?v=...">
        </div>

        <button type="submit" class="btn btn-primary w-100 btn-icon" id="submit-btn">
            <i class="bi {{ isset($news) ? 'bi-pencil-square' : 'bi-plus-circle' }}"></i>
            {{ isset($news) ? 'Update News' : 'Create News' }}
            <span id="submit-spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
        </button>
    </form>

    @if($allNews->isNotEmpty())
    <div class="mt-5">
        <h4 class="text-secondary"><i class="bi bi-collection-fill"></i> Existing News Items</h4>
        <table class="table table-hover table-bordered mt-3 bg-white">
            <thead class="table-light">
                <tr>
                    <th>Title</th>
                    <th>Image</th>
                    <th>YouTube</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allNews as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td>
                            @if($item->image_url)
                                <img src="{{ $item->image_url }}" style="height: 50px; border-radius: 6px;">
                            @endif
                        </td>
                        <td>
                            @if($item->youtube_link)
                                <a href="{{ $item->youtube_link }}" target="_blank" class="btn btn-outline-danger btn-sm"><i class="bi bi-youtube"></i> View</a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('news.edit', $item->id) }}" class="btn btn-warning btn-sm btn-icon mb-1">
                                <i class="bi bi-pencil"></i> Edit
                            </a>

                            <form action="{{ route('news.destroy', $item->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Delete this news item?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm btn-icon">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('news-form').addEventListener('submit', function () {
        const btn = document.getElementById('submit-btn');
        const spinner = document.getElementById('submit-spinner');
        const isEdit = @json(isset($news));
        btn.disabled = true;
        btn.innerHTML = (isEdit ? 'Updating' : 'Creating') + '...';
        spinner.classList.remove('d-none');
        btn.appendChild(spinner);
    });
</script>
@endsection
