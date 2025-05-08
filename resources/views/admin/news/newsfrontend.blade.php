@extends('layouts.layout')
@section('title', 'News')
@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Latest News</h2>
    <div class="row">
        @foreach($news as $item)
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                @if($item->image_url)
                    <img src="{{ $item->image_url }}" class="card-img-top" style="max-height: 200px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $item->title }}</h5>
                    <p class="card-text">{{ Str::limit($item->content, 150) }}</p>

                    @if($item->youtube_link)
                    <div class="ratio ratio-16x9 mb-2">
                        <iframe src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::after($item->youtube_link, 'v=') }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
