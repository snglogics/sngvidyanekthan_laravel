@extends('layouts.admin')
@section('breadcrumb-title', 'Gallery')
@section('breadcrumb-link', route('admin.galleries'))
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
    .form-section .card-header i {
        margin-right: 0.5rem;
    }
    .gallery-img {
        width: 100px;
        height: 100px;
        object-fit: cover;
    }
</style>
@endsection

@section('content')
<div class="container py-4">

    {{-- Create Main Gallery --}}
    <div class="card mb-4 form-section">
        <div class="card-header bg-primary text-white d-flex align-items-center">
            <i class="bi bi-images"></i> Create Main Gallery
        </div>
        <div class="card-body">
            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <label class="form-label">Gallery Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter gallery name" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Main Image</label>
                    <input type="file" name="main_image" class="form-control">
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Create</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Add Subcategory --}}
    <div class="card mb-4 form-section">
        <div class="card-header bg-success text-white d-flex align-items-center">
            <i class="bi bi-folder-plus"></i> Add Subcategory
        </div>
        <div class="card-body">
            <form action="{{ route('admin.gallery.subgallery.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                @csrf
                <div class="col-md-4">
                    <label class="form-label">Select Gallery</label>
                    <select name="gallery_id" class="form-select" required>
                        @foreach($galleries as $gallery)
                            <option value="{{ $gallery->id }}">{{ $gallery->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Subcategory Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Subcategory Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-success"><i class="bi bi-plus-square me-1"></i> Add Subcategory</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Upload Image Group --}}
    <div class="card mb-4 form-section">
        <div class="card-header bg-info text-white d-flex align-items-center">
            <i class="bi bi-upload"></i> Upload Image Group
        </div>
        <div class="card-body">
            <form action="{{ route('admin.gallery.group.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                @csrf
                <div class="col-md-4">
                    <label class="form-label">Select Subcategory</label>
                    <select name="sub_gallery_id" class="form-select" required>
                        @foreach($subgalleries as $sub)
                            <option value="{{ $sub->id }}">{{ $sub->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Group Title</label>
                    <input type="text" name="group_title" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Select Images</label>
                    <input type="file" name="images[]" class="form-control" multiple required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Image Titles (optional)</label>
                    <input type="text" name="titles[]" class="form-control" placeholder="Image 1 title">
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-info"><i class="bi bi-cloud-arrow-up me-1"></i> Upload</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Gallery View --}}
    <h4 class="my-4"><i class="bi bi-card-image me-2"></i>Gallery Overview</h4>
    @foreach($galleries as $gallery)
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <span><i class="bi bi-collection me-2"></i>{{ $gallery->title }}</span>
            </div>
            <div class="card-body">
                @if($gallery->main_image)
                    <img src="{{ $gallery->main_image }}" class="img-fluid rounded mb-3" style="max-width: 200px;">
                @endif

                @foreach($gallery->subGalleries as $sub)
                    <div class="mt-4">
                        <h5 class="text-success"><i class="bi bi-tags me-1"></i>{{ $sub->title }}</h5>
                        @if($sub->image)
                            <img src="{{ $sub->image }}" class="img-thumbnail mb-2" style="max-width: 120px;">
                        @endif

                        @foreach($sub->imageGroups as $group)
                            <div class="mt-3">
                                <h6 class="text-muted"><i class="bi bi-images me-1"></i>{{ $group->title }}</h6>
                                <div class="d-flex flex-nowrap overflow-auto pb-2" style="gap: 1rem;">
                                    @foreach($group->images as $img)
                                        <div class="text-center" style="width: 120px; flex: 0 0 auto;">
                                            <img src="{{ $img->image_url }}" class="img-thumbnail gallery-img mb-1">
                                            @if($img->title)
                                                <small class="text-muted d-block">{{ $img->title }}</small>
                                            @endif
                                            <form action="{{ route('admin.gallery.image.delete', $img->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger mt-1">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

</div>
@endsection
