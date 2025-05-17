@extends('layouts.layout')

@section('title', 'Student Field Trips and Tours')

@section('content')
<div class="container py-5">
    <h2 class="text-center text-primary mb-5"><i class="fas fa-bus"></i> Student Field Trips and Tours</h2>

    @if($trips->isEmpty())
        <div class="alert alert-warning text-center">No field trips available at the moment.</div>
    @else
        <div class="row">
            @foreach($trips as $trip)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-lg rounded-4 border-0">
                    @if($trip->image_url)
                        <img src="{{ $trip->image_url }}" class="card-img-top rounded-top-4" alt="{{ $trip->title }}" style="height: 250px; object-fit: cover;">
                    @else
                        <div class="card-img-top rounded-top-4 bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 250px;">
                            No Image
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $trip->title }}</h5>
                        <p class="card-subtitle mb-2 text-muted">{{ $trip->location }}</p>
                        <p>
                            <strong>Start Date:</strong> {{ date('d M Y', strtotime($trip->start_date)) }}<br>
                            <strong>End Date:</strong> {{ date('d M Y', strtotime($trip->end_date)) }}<br>
                            <strong>Contact:</strong> {{ $trip->contact_person }} ({{ $trip->contact_number }})
                        </p>
                        <p class="card-text">{{ Str::limit($trip->description, 100) }}</p>
                        <a href="{{ route('frontend.field_trips.show', $trip->id) }}" class="btn btn-primary btn-sm w-100">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
