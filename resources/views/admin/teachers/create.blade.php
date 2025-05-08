@extends('layouts.admin')

@section('title', 'Manage Announcements')

@section('styles')
<link href="{{ asset('frontend/css/uploadPrincipal.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <h2>Add New Teacher</h2>
    <form action="{{ route('teachers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Designation</label>
            <input type="text" name="designation" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Years of Experience</label>
            <input type="number" name="experience" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Photo</label>
            <input type="file" name="photo" class="form-control">
        </div>
        <button class="btn btn-success">Add Teacher</button>
    </form>
</div>
@endsection
