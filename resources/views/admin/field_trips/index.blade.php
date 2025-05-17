@extends('layouts.admin')

@section('title', 'Field Trips and Tours')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4 text-primary">Field Trips and Tours</h2>

    <!-- Add Field Trip Button -->
    <a href="{{ route('admin.field_trips.create') }}" class="btn btn-success mb-4">+ Add Field Trip</a>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Field Trip Cards -->
    <div class="row">
        @foreach($trips as $trip)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-lg rounded-4 border-0">
                @if($trip->image_url)
                    <img src="{{ $trip->image_url }}" class="card-img-top rounded-top-4" alt="{{ $trip->title }}" style="height: 200px; object-fit: cover;">
                @else
                    <div class="card-img-top rounded-top-4 bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                        No Image
                    </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title text-primary">{{ $trip->title }}</h5>
                    <p class="card-subtitle mb-2 text-muted">{{ $trip->location }}</p>
                    <p class="card-text">
                        <strong>Start Date:</strong> {{ date('d M Y', strtotime($trip->start_date)) }}<br>
                        <strong>End Date:</strong> {{ date('d M Y', strtotime($trip->end_date)) }}<br>
                        <strong>Contact:</strong> {{ $trip->contact_person }} ({{ $trip->contact_number }})
                    </p>
                    <p class="card-text">{{ Str::limit($trip->description, 80) }}</p>

                    <!-- Edit Button -->
                    <a href="{{ route('admin.field_trips.edit', $trip->id) }}" class="btn btn-warning btn-sm mb-2 w-100">
                        <i class="fas fa-edit"></i> Edit
                    </a>

                    <!-- Delete Button -->
                    <form action="{{ route('admin.field_trips.destroy', $trip->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this trip?')" class="w-100">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm w-100">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
