@extends('layouts.layout')

@section('title', $trip->title)

@section('content')
<div class="container py-5">
    <div class="card shadow-lg rounded-4 border-0">
        @if($trip->image_url)
            <img src="{{ $trip->image_url }}" class="card-img-top rounded-top-4" alt="{{ $trip->title }}" style="height: 400px; object-fit: cover;">
        @else
            <div class="card-img-top rounded-top-4 bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 400px;">
                No Image Available
            </div>
        @endif

        <div class="card-body">
            <h2 class="card-title text-primary">{{ $trip->title }}</h2>
            <p class="card-subtitle mb-2 text-muted">{{ $trip->location }}</p>
            <p><strong>Start Date:</strong> {{ date('d M Y', strtotime($trip->start_date)) }}</p>
            <p><strong>End Date:</strong> {{ date('d M Y', strtotime($trip->end_date)) }}</p>
            <p><strong>Contact:</strong> {{ $trip->contact_person }} ({{ $trip->contact_number }})</p>
            <p>{{ $trip->description }}</p>
            <a href="{{ route('frontend.field_trips.index') }}" class="btn btn-secondary">Back to Trips</a>
        </div>
    </div>
</div>
@endsection
