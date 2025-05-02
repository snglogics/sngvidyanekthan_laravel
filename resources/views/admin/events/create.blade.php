@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Glass Card -->
            <div class="card shadow-lg border-0 rounded-4 bg-light bg-opacity-75 p-4 animate__animated animate__fadeInUp" style="backdrop-filter: blur(10px);">

                <h3 class="text-center mb-4 text-primary">
                    <i class="fas fa-calendar-plus me-2"></i>Upload New Event
                </h3>

                @if(session('success'))
                    <div class="alert alert-success animate__animated animate__fadeIn">{{ session('success') }}</div>
                @endif

                <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="row g-4">
                    @csrf

                    <!-- Heading -->
                    <div class="col-md-12">
                        <label for="heading" class="form-label fw-semibold text-dark">
                            <i class="fas fa-heading me-2 text-secondary"></i>Heading
                        </label>
                        <input type="text" class="form-control form-control-lg" name="heading" id="heading" required placeholder="Enter event title">
                    </div>

                    <!-- Description -->
                    <div class="col-md-12">
                        <label for="description" class="form-label fw-semibold text-dark">
                            <i class="fas fa-align-left me-2 text-secondary"></i>Description
                        </label>
                        <textarea class="form-control" name="description" id="description" rows="4" placeholder="Write a brief description..."></textarea>
                    </div>

                    <!-- Event Date -->
                    <div class="col-md-6">
                        <label for="event_date" class="form-label fw-semibold text-dark">
                            <i class="fas fa-calendar-day me-2 text-secondary"></i>Date
                        </label>
                        <input type="date" class="form-control" name="event_date" id="event_date" required>
                    </div>

                    <!-- Time Interval -->
                    <div class="col-md-6">
                        <label for="time_interval" class="form-label fw-semibold text-dark">
                            <i class="fas fa-clock me-2 text-secondary"></i>Time Interval
                        </label>
                        <input type="text" class="form-control" name="time_interval" id="time_interval" placeholder="e.g., 10:00 AM - 1:00 PM" required>
                    </div>

                    <!-- Venue -->
                    <div class="col-md-12">
                        <label for="venue" class="form-label fw-semibold text-dark">
                            <i class="fas fa-map-marker-alt me-2 text-secondary"></i>Venue
                        </label>
                        <input type="text" class="form-control" name="venue" id="venue" required placeholder="Event location">
                    </div>

                    <!-- Image -->
                    <div class="col-md-12">
                        <label for="image" class="form-label fw-semibold text-dark">
                            <i class="fas fa-image me-2 text-secondary"></i>Event Image
                        </label>
                        <input type="file" class="form-control" name="image" id="image" accept="image/*" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12 text-end mt-3">
                        <button type="submit" class="btn btn-gradient-primary btn-lg px-4 py-2 animate__animated animate__pulse animate__infinite">
                            <i class="fas fa-upload me-2"></i>Upload Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
