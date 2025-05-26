@extends('layouts.admin')

@section('breadcrumb-title', 'Events list')
@section('breadcrumb-link', route('admin.events.index'))

@section('styles')
<!-- Animate.css & Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

<!-- Custom Styling -->
<style>
    body {
        background: linear-gradient(to right, #dfe9f3, #ffffff);
    }

    .card {
        background: rgba(255, 255, 255, 0.85);
        border-radius: 1.5rem;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(12px);
        padding: 2rem;
        animation: fadeInUp 0.5s ease-in-out;
    }

    .form-label i {
        margin-right: 0.5rem;
        color: #0d6efd;
    }

    .form-control, .form-select {
        border-radius: 12px;
        border: 1px solid #ced4da;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: box-shadow 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        border-color: #0d6efd;
    }

    .btn-gradient-primary {
        background: linear-gradient(to right, #0d6efd, #6610f2);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
    }

    .btn-gradient-primary:hover {
        background: linear-gradient(to right, #6610f2, #0d6efd);
        transform: translateY(-2px);
    }

    .section-title {
        font-weight: bold;
        font-size: 1.75rem;
        color: #343a40;
        text-align: center;
    }

    .alert-success {
        border-left: 6px solid #198754;
        border-radius: 10px;
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            <div class="card animate__animated animate__fadeInUp">

               <h3 class="section-title mb-4">
    <i class="fas fa-calendar-plus me-2 text-primary"></i> Upload New Event
</h3>

<div class="text-end mb-3">
    <a href="{{ route('admin.events.index') }}" class="btn btn-outline-primary">
        <i class="fas fa-list me-1"></i> Show Event List
    </a>
</div>

                @if(session('success'))
                    <div class="alert alert-success animate__animated animate__fadeIn">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    </div>
                @endif

                <form id="createForm" action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="row g-4">

                    @csrf

                    <!-- Heading -->
                    <div class="col-md-12">
                        <label for="heading" class="form-label">
                            <i class="fas fa-heading"></i> Event Title
                        </label>
                        <input type="text" class="form-control" name="heading" id="heading" required placeholder="Enter event title">
                    </div>

                    <!-- Description -->
                    <div class="col-md-12">
                        <label for="description" class="form-label">
                            <i class="fas fa-align-left"></i> Description
                        </label>
                        <textarea class="form-control" name="description" id="description" rows="4" placeholder="Write a brief description..."></textarea>
                    </div>

                    <!-- Event Date -->
                    <div class="col-md-6">
                        <label for="event_date" class="form-label">
                            <i class="fas fa-calendar-day"></i> Date
                        </label>
                        <input type="date" class="form-control" name="event_date" id="event_date" required>
                    </div>

                    <!-- Time Interval -->
                    <div class="col-md-6">
                        <label for="time_interval" class="form-label">
                            <i class="fas fa-clock"></i> Time Interval
                        </label>
                        <input type="text" class="form-control" name="time_interval" id="time_interval" placeholder="e.g., 10:00 AM - 1:00 PM" required>
                    </div>

                    <!-- Venue -->
                    <div class="col-md-12">
                        <label for="venue" class="form-label">
                            <i class="fas fa-map-marker-alt"></i> Venue
                        </label>
                        <input type="text" class="form-control" name="venue" id="venue" required placeholder="Event location">
                    </div>

                    <!-- Image Upload -->
                    <div class="col-md-12">
                        <label for="image" class="form-label">
                            <i class="fas fa-image"></i> Event Image
                        </label>
                        <input type="file" class="form-control" name="image" id="image" accept="image/*" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12 text-end mt-3">
                        <button type="submit" id="submitBtn" class="btn btn-gradient-primary px-5 py-2">
    <i class="fas fa-upload me-2"></i>Upload Event
</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('createForm').addEventListener('submit', function () {
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Saving...';
    });
</script>



<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection
