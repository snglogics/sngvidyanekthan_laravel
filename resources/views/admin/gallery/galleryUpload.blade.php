@extends('layouts.admin')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Create Main Gallery</h2>
    <div class="card mb-5">
        <div class="card-body">
            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <label class="form-label">Gallery Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Main Image</label>
                    <input type="file" name="main_image" class="form-control">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Create Gallery</button>
                </div>
            </form>
        </div>
    </div>

    <h2 class="mb-4">Add Subcategory</h2>
    <div class="card mb-5">
        <div class="card-body">
            <form action="{{ route('admin.gallery.subgallery.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <label class="form-label">Select Gallery</label>
                    <select name="gallery_id" class="form-select" required>
                        @foreach($galleries as $gallery)
                            <option value="{{ $gallery->id }}">{{ $gallery->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Subcategory Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Subcategory Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success">Add Subcategory</button>
                </div>
            </form>
        </div>
    </div>

    <h2 class="mb-4">Upload Image Group</h2>
    <div class="card mb-5">
        <div class="card-body">
            <form action="{{ route('admin.gallery.group.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <label class="form-label">Select Subcategory</label>
                    <select name="sub_gallery_id" class="form-select" required>
                        @foreach($subgalleries as $sub)
                            <option value="{{ $sub->id }}">{{ $sub->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Group Title</label>
                    <input type="text" name="group_title" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Select Images</label>
                    <input type="file" name="images[]" class="form-control" multiple required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Image Titles (optional)</label>
                    <input type="text" name="titles[]" class="form-control" placeholder="Image 1 title">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-info">Upload</button>
                </div>
            </form>
        </div>
    </div>

    <h2 class="mb-4">Gallery View</h2>
    <h2 class="mb-4">Gallery View</h2>
@foreach($galleries as $gallery)
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <strong>{{ $gallery->title }}</strong>
        </div>
        <div class="card-body">
            @if($gallery->main_image)
                <img src="{{ $gallery->main_image }}" class="img-fluid rounded mb-3" style="max-width: 200px;">
            @endif

            @foreach($gallery->subGalleries as $sub)
                <h5 class="text-success mt-4">{{ $sub->title }}</h5>
                @if($sub->image)
                    <img src="{{ $sub->image }}" class="img-thumbnail mb-2" style="max-width: 120px;">
                @endif

                @foreach($sub->imageGroups as $group)
                    <div class="mt-4">
                        <h6 class="text-muted">{{ $group->title }}</h6>
                        <div class="d-flex flex-nowrap overflow-auto pb-2" style="gap: 1rem;">
                            @foreach($group->images as $img)
                                <div class="text-center" style="width: 120px; flex: 0 0 auto;">
                                    <img src="{{ $img->image_url }}" class="img-thumbnail mb-1" style="width: 100px; height: 100px; object-fit: cover;">
                                    @if($img->title)
                                        <small class="text-muted d-block">{{ $img->title }}</small>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
@endforeach



</div>
@endsection