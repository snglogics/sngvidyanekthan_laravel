@extends('layouts.admin')

@section('title', 'Edit Sports & Game')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4 text-primary">Edit Sports & Game</h2>

    <form action="{{ route('admin.sports_games.update', $sportsGame->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $sportsGame->title }}" required>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" name="category" class="form-control" value="{{ $sportsGame->category }}" required>
        </div>

        <div class="mb-3">
            <label for="coach_name" class="form-label">Coach Name</label>
            <input type="text" name="coach_name" class="form-control" value="{{ $sportsGame->coach_name }}">
        </div>

        <div class="mb-3">
            <label for="contact_number" class="form-label">Contact Number</label>
            <input type="text" name="contact_number" class="form-control" value="{{ $sportsGame->contact_number }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" required>{{ $sportsGame->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Sports/Game Image</label>
            <input type="file" name="image" class="form-control">
            
            @if($sportsGame->image_url)
                <img src="{{ $sportsGame->image_url }}" class="mt-3" style="max-width: 200px;">
                <small class="text-muted d-block">Current Image</small>
            @endif
        </div>

        <button type="submit" class="btn btn-primary w-100">Update Sports/Game</button>
    </form>
</div>
@endsection
