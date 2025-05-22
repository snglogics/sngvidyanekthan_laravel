@extends('layouts.layout')

@section('title', 'Live Classes')
 @section('breadcrumb-title', 'Faculty')
@section('breadcrumb-link', route('admin.faculties'))
@section('hero_title', 'Upcoming Live Classes')
@section('content')
<div class="container py-5">
   

    @forelse($classes as $class)
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">{{ $class->title }}</h5>
                <p class="card-text text-muted">{{ $class->description }}</p>
                <p><i class="bi bi-clock"></i> Scheduled: {{ \Carbon\Carbon::parse($class->scheduled_at)->format('d M Y, h:i A') }}</p>
                <p><i class="bi bi-camera-video"></i> Platform: {{ $class->platform }}</p>
                @if(Str::contains($class->link, 'zoom'))
    <div class="ratio ratio-16x9 mb-3">
        <iframe src="{{ $class->link }}" allowfullscreen allow="camera; microphone; fullscreen" frameborder="0"></iframe>
    </div>
@else
    <a href="{{ $class->link }}" target="_blank" class="btn btn-success">Join Now</a>
@endif

            </div>
        </div>
    @empty
        <p class="text-center text-danger">No upcoming classes available.</p>
    @endforelse
</div>
@endsection
