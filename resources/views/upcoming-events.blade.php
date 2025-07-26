@extends('layouts.layout')

@section('styles')
    <style>
        .parallax-bg {
            background-image: url('/frontend/images/aboutusImg.jpg');
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            padding: 30px;
            border-radius: 10px;
        }
    </style>
@endsection

@section('hero_title', 'Upcoming Events')



@section('content')
<div class="about-event mt-50">
    <div class="event-title">
        <h3>Upcoming events</h3>
    </div>

    <div style="max-height: 300px; overflow-y: auto;">
        <ul class="list-unstyled">
            @forelse($upcomingEvent as $event)
                <li class="mb-3">
                    <div class="singel-event">
                        <span><i class="fa fa-calendar"></i>
                            {{ \Carbon\Carbon::parse($event->event_date)->format('d F Y') }}</span>
                        <a href="#">
                            <h4>{{ $event->heading }}</h4>
                        </a>
                        <span><i class="fa fa-clock-o"></i> {{ $event->time_interval }}</span>
                        <span><i class="fa fa-map-marker"></i> {{ $event->venue }}</span>
                    </div>
                </li>
            @empty
                <li>
                    <p>No upcoming events.</p>
                </li>
            @endforelse
        </ul>
    </div>
</div>
@endsection