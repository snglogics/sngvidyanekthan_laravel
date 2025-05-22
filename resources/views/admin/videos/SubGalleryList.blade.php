@extends('layouts.layout')
@section('hero_title', 'Sub-Gallery')
@section('content')
<div class="container py-5">
    <h2 class="mb-4">Sub Galleries of {{ $gallery->title }}</h2>

    <div class="row g-4">
        @foreach($subGalleries as $sub)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0">
                    @if($sub->image)
                        <img src="{{ $sub->image }}" class="card-img-top rounded-top" style="height: 200px; object-fit: cover;" alt="{{ $sub->title }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center">{{ $sub->title }}</h5>
                        <div class="mt-auto text-center">
                            <a href="{{ route('subgallery.imagegroups', $sub->id) }}" class="btn btn-outline-success mt-2">View Images</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        <a href="{{ route('gallery.list') }}" class="btn btn-secondary">
            ← Back to Galleries
        </a>
    </div>
</div>
@endsection
