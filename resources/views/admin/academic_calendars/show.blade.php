@extends('layouts.layout')

@section('title', $event->event_name)

@section('content')
<div class="container py-5">
    <h2 class="mb-4"><i class="bi bi-calendar-event text-primary me-2"></i>{{ $event->event_name }}</h2>
    <p><strong>Date:</strong> {{ $event->start_date }} to {{ $event->end_date }}</p>
    <p><strong>Academic Year:</strong> {{ $event->academic_year }}</p>
    <p><strong>Audience:</strong> {{ $event->audience }}</p>
    <p><strong>Description:</strong></p>
    <div class="border rounded p-3 bg-light text-dark">
        {{ $event->description }}
    </div>

    @if($event->attachment_url)
        <div class="mt-4">
            <h5>Attachment:</h5>
            @php
                $ext = pathinfo($event->attachment_url, PATHINFO_EXTENSION);
            @endphp

            @if(in_array(strtolower($ext), ['jpg', 'jpeg', 'png']))
                <img src="{{ $event->attachment_url }}" class="img-fluid rounded shadow-sm" alt="Attachment Image">
            @elseif(strtolower($ext) === 'pdf')
                <embed src="{{ $event->attachment_url }}" type="application/pdf" width="100%" height="500px" class="rounded shadow-sm"/>
            @else
                <a href="{{ $event->attachment_url }}" target="_blank" class="btn btn-outline-primary">
                    <i class="bi bi-download"></i> Download Attachment
                </a>
            @endif
        </div>
    @else
        <p class="text-muted"><i class="bi bi-file-earmark-x"></i> No attachment available.</p>
    @endif

    <a href="/academic-calendars" class="btn btn-secondary mt-4">
        <i class="bi bi-arrow-left"></i> Back to Events
    </a>
</div>
@endsection
