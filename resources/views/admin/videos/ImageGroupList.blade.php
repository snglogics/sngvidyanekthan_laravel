@extends('layouts.layout')
@section('content')
@section('hero_title', 'Gallery List')

<div class="container py-5">
    <h2 class="mb-4">Image Groups in {{ $subGallery->title }}</h2>

    @foreach($groupedImageGroups as $title => $images)
        <div class="mb-5">
            <h4 class="text-primary">{{ $title ?: 'Untitled Group' }}</h4>
            <div class="row">
                @foreach($images as $img)
                    <div class="col-md-3 col-sm-4 col-6 mb-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="{{ $img->image_url }}" class="card-img-top rounded" alt="{{ $img->title }}">
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

<a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">
    ← Back to Sub Galleries
</a>
@endsection
