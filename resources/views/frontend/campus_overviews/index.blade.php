@extends('layouts.layout') 

@section('title', 'Campus Overviews')

@section('content')
<div class="container py-5">
    <h1 class="mb-5 text-center">Campus Overviews</h1>

    @if($overviews->count())
        @foreach($overviews as $campusOverview)
            <div class="mb-5">
                <h2 class="mb-3">{{ $campusOverview->main_heading }}</h2>
                <p class="lead mb-4">{{ $campusOverview->description }}</p>

                @if(!empty($campusOverview->photos) && is_array($campusOverview->photos))
                    <div class="row g-4 justify-content-center">
                        @foreach($campusOverview->photos as $photo)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 text-center">
                                <div class="card shadow-sm h-100">
                                    <img 
                                        src="{{ $photo['url'] ?? asset('images/placeholder.png') }}" 
                                        alt="{{ $photo['title'] ?? 'Campus Photo' }}" 
                                        class="card-img-top" 
                                        style="height: 200px; object-fit: cover;"
                                    >
                                    @if(!empty($photo['title']))
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $photo['title'] }}</h6>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">No photos available.</p>
                @endif
            </div>
        @endforeach
    @else
        <p class="text-center text-muted">No campus overviews found.</p>
    @endif
</div>
@endsection
