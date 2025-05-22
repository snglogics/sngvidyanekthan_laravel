@extends('layouts.layout')

@section('title', $program->name)
@section('hero_title', 'Our Co-Curricular Programs')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg rounded-4 border-0">
        @if($program->image_url)
            <img src="{{ $program->image_url }}" class="card-img-top rounded-top-4" alt="{{ $program->name }}" style="height: 400px; object-fit: cover;">
        @else
            <div class="card-img-top rounded-top-4 bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 400px;">
                No Image Available
            </div>
        @endif

        <div class="card-body">
            <h2 class="card-title text-primary">{{ $program->name }}</h2>
            <p class="card-subtitle mb-2 text-muted">{{ $program->category }}</p>
            <p class="card-text">{{ $program->description }}</p>
            <a href="{{ route('frontend.co_curricular_programs.index') }}" class="btn btn-secondary">Back to list</a>
        </div>
    </div>
</div>
@endsection
