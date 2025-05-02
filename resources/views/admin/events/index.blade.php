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
                    <img src="{{ $event->image_url }}" class="card-img-top" alt="{{ $event->heading }}">
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
@endsection
