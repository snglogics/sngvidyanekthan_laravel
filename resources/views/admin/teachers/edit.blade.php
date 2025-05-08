@extends('layouts.admin')

@section('title', 'Edit Teacher')

@section('content')
<div class="container">
    <h2>Edit Teacher</h2>
    <form action="{{ route('teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $teacher->name }}" required>
        </div>

        <div class="mb-3">
            <label>Designation</label>
            <input type="text" name="designation" class="form-control" value="{{ $teacher->designation }}" required>
        </div>

        <div class="mb-3">
            <label>Experience</label>
            <input type="number" name="experience" class="form-control" value="{{ $teacher->experience }}" required>
        </div>

        <div class="mb-3">
            <label>Photo</label>
            <input type="file" name="photo" class="form-control">
            @if($teacher->photo)
                <img src="{{ $teacher->photo }}" class="mt-2" style="width: 100px;">
            @endif
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
