@extends('layouts.app')
@section('hero_title', 'Gallery')
@section('content')
<div class="container py-5">
    <h2 class="text-center mb-5">Gallery</h2>

    @foreach($galleries as $gallery)
        <div class="mb-5">
            <h3 class="text-primary mb-3">
                <i class="fas fa-images"></i> {{ $gallery->title }}
            </h3>
            @if($gallery->main_image)
                <img src="{{ $gallery->main_image }}" class="img-fluid mb-4 rounded shadow" alt="{{ $gallery->title }}">
            @endif

            @foreach($gallery->subGalleries as $sub)
                <div class="ms-4 mb-4">
                    <h4 class="text-success">
                        <i class="fas fa-folder-open"></i> {{ $sub->title }}
                    </h4>
                    @if($sub->image)
                        <img src="{{ $sub->image }}" class="img-thumbnail mb-3" style="max-width: 300px;" alt="{{ $sub->title }}">
                    @endif

                    @foreach($sub->imageGroups as $group)
                        <div class="ms-3 mb-3">
                            <h5 class="text-dark">
                                <i class="fas fa-layer-group"></i> {{ $group->title }}
                            </h5>
                            <div class="row g-3">
                                @foreach($group->images as $img)
                                    <div class="col-md-3 col-sm-4 col-6 wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="card h-100 border-0 shadow-sm">
                                            <img src="{{ $img->image_url }}" class="card-img-top rounded" alt="Image">
                                            @if($img->title)
                                                <div class="card-body p-2">
                                                    <p class="card-text text-center">{{ $img->title }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    @endforeach
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>
    new WOW().init();
</script>
@endpush