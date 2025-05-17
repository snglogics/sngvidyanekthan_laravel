@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Uploaded Events</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse ($events as $event)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ $event->image_url }}" 
                        class="card-img-top" 
                        alt="{{ $event->heading }}" 
                        style="cursor: pointer;"
                        onclick="showFullImage('{{ $event->image_url }}')">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->heading }}</h5>
                        <p class="card-text"><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</p>
                        <p class="card-text"><strong>Time:</strong> {{ $event->time_interval }}</p>
                        <p class="card-text"><strong>Venue:</strong> {{ $event->venue }}</p>
                        <p class="card-text">{{ $event->description }}</p>
                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm mt-2">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">No events uploaded yet.</div>
            </div>
        @endforelse
    </div>
</div>

<!-- Place Modal Outside Loop -->
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
    document.addEventListener("DOMContentLoaded", function () {
        window.showFullImage = function(url) {
            const modalImg = document.getElementById('modalImage');
            modalImg.src = url;
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            modal.show();
        }
    });
</script>
@endsection