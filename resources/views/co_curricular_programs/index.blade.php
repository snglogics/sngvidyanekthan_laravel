@extends('layouts.layout')

@section('title', 'Co-Curricular Programs')

@section('content')
<div class="container py-5">
    <h2 class="text-center text-primary mb-5"><i class="fas fa-star"></i> Our Co-Curricular Programs</h2>

    <div class="row">
        @foreach($programs as $program)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-lg rounded-4 border-0">
                @if($program->image_url)
                    <img src="{{ $program->image_url }}" class="card-img-top rounded-top-4" alt="{{ $program->name }}" style="height: 250px; object-fit: cover;">
                @else
                    <div class="card-img-top rounded-top-4 bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 250px;">
                        No Image
                    </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title text-primary">{{ $program->name }}</h5>
                    <p class="card-subtitle mb-2 text-muted">{{ $program->category }}</p>
                    <p class="card-text">{{ Str::limit($program->description, 100) }}</p>
                    <a href="{{ route('frontend.co_curricular_programs.show', $program->id) }}" class="btn btn-primary btn-sm w-100">
                        View Details
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
