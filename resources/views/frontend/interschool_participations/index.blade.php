@extends('layouts.layout')

@section('title', 'Interschool Participations')
@section('hero_title', 'Student Interschool Participation')

@section('styles')
<style>
    .parallax-bg {
        background-image: url('/frontend/images/parallel20.jpg');
        background-attachment: fixed;
        background-size: cover;
        background-position: center;
        padding: 80px 0;
        color: white;
    }

    .participation-card {
        background-color: rgba(255, 255, 255, 0.5);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .card-img {
        height: 100%;
        object-fit: cover;
        min-height: 250px;
    }

    .card-body {
        padding: 1.5rem;
    }
</style>
@endsection

@section('content')
<div class="parallax-bg">
    <div class="container">
        @if($participations->count())
            <div class="row gy-4">
                @foreach($participations as $participation)
                    <div class="col-12">
                        <div class="d-flex flex-column flex-md-row participation-card">
                            @if($participation->photo_url)
                                <div class="col-md-4 p-0">
                                    <img src="{{ $participation->photo_url }}" alt="Participation Photo" class="img-fluid card-img w-100">
                                </div>
                            @endif
                            <div class="col-md-8 card-body bg-light">
                                <h4 class="text-primary">
                                    <i class="fas fa-user-graduate me-2"></i>{{ $participation->student_name }}
                                </h4>
                                <p><i class="fas fa-medal me-2 text-warning"></i><strong>Event:</strong> {{ $participation->event_name }}</p>
                                <p><i class="fas fa-calendar-day me-2 text-info"></i><strong>Date:</strong> {{ $participation->event_date->format('d M Y') }}</p>
                                <p><i class="fas fa-trophy me-2 text-success"></i><strong>Position:</strong> {{ $participation->position ?? 'Participant' }}</p>
                                <p><i class="fas fa-school me-2 text-secondary"></i><strong>School:</strong> {{ $participation->school_name }}</p>
                                @if($participation->remarks)
                                    <p class="fst-italic text-muted mt-2"><i class="fas fa-comment-dots me-2"></i>{{ $participation->remarks }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $participations->links() }}
            </div>
        @else
            <p class="text-center text-white fs-5">No participation records found.</p>
        @endif
    </div>
</div>
@endsection
