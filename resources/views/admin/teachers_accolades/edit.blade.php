@extends('layouts.admin')

@section('title', 'Edit Teacher Accolade')

@section('content')
<div class="container mt-4">
    <h2>Edit Teacher Accolade</h2>
    <pre>{{ print_r($teacherAccolade->toArray()) }}</pre>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.teachers_accolades.update', $teacherAccolade) }}" method="POST" enctype="multipart/form-data">

    @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="teacher_name" class="form-label">Teacher Name</label>
            <input type="text" name="teacher_name" id="teacher_name" class="form-control" value="{{ $teacherAccolade->teacher_name }}" required>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $teacherAccolade->title }}" required>
        </div>

        <div class="mb-3">
            <label for="year" class="form-label">Year</label>
            <input type="text" name="year" id="year" class="form-control" value="{{ $teacherAccolade->year }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ $teacherAccolade->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            @if($teacherAccolade->image_url)
                <img src="{{ $teacherAccolade->image_url }}" alt="{{ $teacherAccolade->title }}" width="150" class="mb-2">
            @endif
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Accolade</button>
    </form>
</div>
@endsection
