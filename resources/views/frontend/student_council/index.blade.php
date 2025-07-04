@extends('layouts.layout')

@section('title', 'Student Council')
@section('hero_title', 'Student Council')
@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-5 fw-bold">Meet Our Student Council Team </h1>

        @if ($members->count())
            <div class="row g-4">
                @foreach ($members as $member)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card h-100 shadow-sm border-0">
                            @if ($member->photo)
                                <img src="{{ $member->photo }}" class="card-img-top rounded-top"
                                    alt="{{ $member->student_name }}">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <span class="text-muted">No Photo</span>
                                </div>
                            @endif
                            <div class="card-body text-center">
                                <h5 class="card-title mb-1">{{ $member->student_name }}</h5>
                                <p class="text-primary small mb-0">{{ $member->position }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center">
                No student council members have been added yet. Please check back later.
            </div>
        @endif
    </div>
@endsection
