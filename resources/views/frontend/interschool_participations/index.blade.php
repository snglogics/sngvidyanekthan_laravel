@extends('layouts.layout')

@section('title', 'Interschool Participations')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">Student Interschool Participation</h1>

    @if($participations->count())
        <div class="row g-4 justify-content-center">
            @foreach($participations as $participation)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card shadow-sm">
                        @if($participation->photo_url)
                            <img src="{{ $participation->photo_url }}" class="card-img-top" alt="Participation Photo" style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $participation->student_name }}</h5>
                            <p><strong>Event:</strong> {{ $participation->event_name }}</p>
                            <p><strong>Date:</strong> {{ $participation->event_date->format('d M Y') }}</p>
                            <p><strong>Position:</strong> {{ $participation->position ?? 'Participant' }}</p>
                            <p><strong>School:</strong> {{ $participation->school_name }}</p>
                            @if($participation->remarks)
                                <p><em>{{ $participation->remarks }}</em></p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $participations->links() }}
    @else
        <p class="text-center text-muted">No participation records found.</p>
    @endif
</div>
@endsection
