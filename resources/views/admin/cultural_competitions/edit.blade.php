@extends('layouts.admin')

@section('title', 'Edit Cultural Competition')

@section('content')
<div class="container mt-4">
    <h2>Edit Cultural Competition</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.cultural_competitions.update', $culturalCompetition->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $culturalCompetition->title }}" required>
        </div>

        <div class="mb-3">
            <label for="competition_year" class="form-label">Competition Year</label>
            <input type="text" name="competition_year" id="competition_year" class="form-control" value="{{ $culturalCompetition->competition_year }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ $culturalCompetition->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            @if($culturalCompetition->image_url)
                <img src="{{ $culturalCompetition->image_url }}" alt="{{ $culturalCompetition->title }}" width="150" class="mb-2">
            @endif
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Competition</button>
    </form>
</div>
@endsection
