@extends('layouts.admin')

@section('title', 'Manage Announcements')

@section('styles')
<link href="{{ asset('frontend/css/uploadPrincipal.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Teachers</h2>
    <a href="{{ route('teachers.create') }}" class="btn btn-warning btn-sm">Add New</a>
</div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($teachers as $teacher)
            <div class="col-md-4 mb-4">
            <div class="card h-100 text-center p-3">
    @if($teacher->photo)
        <img src="{{ $teacher->photo }}" class="img-fluid rounded-circle mx-auto mb-3" style="width:120px; height:120px; object-fit:cover;">
    @endif
    <h5>{{ $teacher->name }}</h5>
    <p class="text-muted">{{ $teacher->designation }}</p>
    <p>{{ $teacher->experience }} years experience</p>

    <div class="d-flex justify-content-center gap-2 mt-2">
        <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-warning btn-sm">Edit</a>
        <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">Delete</button>
        </form>
    </div>
</div>
            </div>
        @endforeach
    </div>
</div>
@endsection
