@extends('layouts.admin')

@section('title', 'Field Trips and Tours')
@section('breadcrumb-title', 'Student Life')
@section('breadcrumb-link', route('admin.studentlife'))

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4 text-primary"><i class="fas fa-map-marked-alt me-2"></i>Field Trips and Tours</h2>

    <!-- Add Field Trip Button -->
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('admin.field_trips.create') }}" class="btn btn-success shadow-sm">
            <i class="fas fa-plus-circle me-2"></i> Add Field Trip
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Field Trip Cards -->
    <div class="row">
        @forelse($trips as $trip)
        <div class="col-12 mb-4">
            <div class="card shadow-sm border-0 rounded-4 trip-card-horizontal overflow-hidden position-relative">
                <div class="row g-0">
                    <!-- Image Section -->
                    <div class="col-md-4">
                        @if($trip->image_url)
                            <img src="{{ $trip->image_url }}" alt="{{ $trip->title }}" class="img-fluid h-100 w-100 object-fit-cover" style="object-fit: cover;">
                        @else
                            <div class="d-flex align-items-center justify-content-center h-100 bg-secondary text-white" style="height: 100%;">
                                <i class="fas fa-image fa-2x me-2"></i> No Image
                            </div>
                        @endif
                    </div>

                    <!-- Details Section -->
                    <div class="col-md-8 p-3 d-flex flex-column">
                        <!-- Badge -->
                        @php
                            $today = now()->toDateString();
                            $status = $trip->start_date > $today ? 'Upcoming' : ($trip->end_date < $today ? 'Past' : 'Ongoing');
                            $badgeClass = $status == 'Upcoming' ? 'primary' : ($status == 'Past' ? 'secondary' : 'success');
                        @endphp
                        <span class="badge bg-{{ $badgeClass }} position-absolute top-0 start-0 m-2 px-3 py-2 rounded-pill">
                            <i class="fas fa-calendar-alt me-1"></i> {{ $status }}
                        </span>

                        <div>
                            <h5 class="card-title text-primary">
                                <i class="fas fa-map-marker-alt me-2 text-danger"></i>{{ $trip->title }}
                            </h5>
                            <p class="text-muted mb-2">{{ $trip->location }}</p>
                            <div class="mb-2">
                                <i class="fas fa-calendar-day me-1 text-info"></i> <strong>Start:</strong> {{ date('d M Y', strtotime($trip->start_date)) }}<br>
                                <i class="fas fa-calendar-check me-1 text-success"></i> <strong>End:</strong> {{ date('d M Y', strtotime($trip->end_date)) }}
                            </div>
                            <p>
                                <i class="fas fa-user-tie me-2 text-dark"></i> <strong>{{ $trip->contact_person }}</strong><br>
                                <i class="fas fa-phone-alt me-2 text-dark"></i> {{ $trip->contact_number }}
                            </p>
                            <p class="text-secondary small">
                                <i class="fas fa-info-circle me-2"></i>{{ Str::limit($trip->description, 100) }}
                            </p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-auto d-flex gap-2">
                            <a href="{{ route('admin.field_trips.edit', $trip->id) }}" class="btn btn-warning btn-sm w-100 shadow-sm">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <form action="{{ route('admin.field_trips.destroy', $trip->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this trip?')" class="w-100">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100 shadow-sm">
                                    <i class="fas fa-trash-alt me-1"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <p class="text-muted"><i class="fas fa-info-circle me-2"></i>No field trips available at the moment.</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Optional: Smooth hover effect -->
<style>
.trip-card-horizontal:hover {
    transform: scale(1.01);
    transition: 0.3s ease;
    box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
}
.object-fit-cover {
    object-fit: cover;
}
</style>
@endsection
