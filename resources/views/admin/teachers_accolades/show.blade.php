@extends('layouts.admin')

@section('title', 'Teacher Accolade Details')

@section('content')
<div class="container mt-4">
    <h2>{{ $teacherAccolade->title }}</h2>

    @if($teacherAccolade->image_url)
        <img src="{{ $teacherAccolade->image_url }}" alt="{{ $teacherAccolade->title }}" width="300" class="mb-3">
    @endif

    <p><strong>Year:</strong> {{ $teacherAccolade->year }}</p>
    <p><strong>Description:</strong> {{ $teacherAccolade->description }}</p>

    <a href="{{ route('admin.teachers_accolades.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
