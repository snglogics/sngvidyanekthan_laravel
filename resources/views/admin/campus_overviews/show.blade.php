@extends('layouts.admin')

@section('title', $campusOverview->main_heading)

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">{{ $campusOverview->main_heading }}</h2>
    <p>{{ $campusOverview->description }}</p>
    <div class="row">
    @foreach($campusOverview->photos as $photo)
    <div class="col-md-4 mb-4">
        <img src="{{ $photo['url'] }}" class="img-fluid rounded" alt="Campus Photo">
        @if(isset($photo['title']) && $photo['title'] !== '')
            <h6 class="mt-2 text-center">{{ $photo['title'] }}</h6>
        @endif
    </div>
@endforeach
    </div>
</div>
@endsection