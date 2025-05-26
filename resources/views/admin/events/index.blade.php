@extends('layouts.admin')

@section('breadcrumb-title', 'About')
@section('breadcrumb-link', route('admin.about'))

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    .card {
        border-radius: 20px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        background: #fdfdfd;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .card-title {
        font-weight: bold;
        color: #0056b3;
    }

    .btn-danger {
        border-radius: 10px;
        background: linear-gradient(45deg, #dc3545, #a71d2a);
        border: none;
    }

    .btn-danger:hover {
        background: linear-gradient(45deg, #a71d2a, #7f1d1d);
    }

    .event-icon {
        margin-right: 6px;
        color: #007bff;
    }

    .alert-info {
        background: linear-gradient(to right, #dbeafe, #eff6ff);
        border-left: 4px solid #3b82f6;
        font-weight: 500;
    }
</style>
@endsection

@section('content')
<div class="container mt-5">
   <h2 class="mb-4 text-primary">
    <i class="fa-solid fa-calendar-days me-2"></i>Upcoming Events
</h2>

<div class="mb-4 text-end">
    <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-circle-plus me-1"></i>Create New Event
    </a>
</div>

    @if(session('success'))
        <div class="alert alert-success animate__animated animate__fadeInDown">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    <div class="row">
        @forelse ($events as $event)
            <div class="col-md-4 mb-4">
                <div class="card shadow h-100">
                    <img src="{{ $event->image_url }}"
                        class="card-img-top"
                        alt="{{ $event->heading }}"
                        style="cursor: pointer;"
                        onclick="showFullImage('{{ $event->image_url }}')">

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">
                            <i class="fa-solid fa-heading event-icon"></i>{{ $event->heading }}
                        </h5>

                        <p class="card-text">
                            <i class="fa-regular fa-calendar-days event-icon"></i>
                            <strong>Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                        </p>

                        <p class="card-text">
                            <i class="fa-regular fa-clock event-icon"></i>
                            <strong>Time:</strong> {{ $event->time_interval }}
                        </p>

                        <p class="card-text">
                            <i class="fa-solid fa-location-dot event-icon"></i>
                            <strong>Venue:</strong> {{ $event->venue }}
                        </p>

                        <p class="card-text">
                            <i class="fa-solid fa-align-left event-icon"></i>
                            {{ $event->description }}
                        </p>

                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="mt-auto" onsubmit="return confirm('Are you sure you want to delete this event?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm mt-3 w-100">
                                <i class="fa-solid fa-trash-can me-1"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fa-regular fa-face-sad-tear me-2"></i>No events uploaded yet.
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Fullscreen Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-dark">
            <div class="modal-body p-0 d-flex justify-content-center align-items-center">
                <img id="modalImage" src="" alt="Full Image" class="img-fluid w-100 h-100" style="object-fit: contain;" />
            </div>
            <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function showFullImage(url) {
        const modalImg = document.getElementById('modalImage');
        modalImg.src = url;
        const modal = new bootstrap.Modal(document.getElementById('imageModal'));
        modal.show();
    }
</script>
@endsection
