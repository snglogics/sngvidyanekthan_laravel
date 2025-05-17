@extends('layouts.admin')

@section('title', 'Co-Curricular Programs')

@section('content')
<div class="container py-5">
    <h2 class="text-primary mb-4">Co-Curricular Programs</h2>
    <a href="{{ route('admin.co_curricular_programs.create') }}" class="btn btn-success mb-4">+ Add Program</a>

    <div class="row">
        @foreach($programs as $program)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-lg rounded-4 border-0">
                <img src="{{ $program->image_url }}" class="card-img-top rounded-top-4" alt="{{ $program->name }}">
                <div class="card-body">
                    <h5 class="card-title text-primary">{{ $program->name }}</h5>
                    <p class="card-subtitle mb-2 text-muted">{{ $program->category }}</p>
                    <p class="card-text">{{ Str::limit($program->description, 100) }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
