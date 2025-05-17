@extends('layouts.admin')

@section('title', 'Add Sports & Game')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4 text-primary">Add Sports & Game</h2>

    <form action="{{ route('admin.sports_games.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" name="category" class="form-control" placeholder="e.g. Indoor, Outdoor, Team Game" required>
        </div>

        <div class="mb-3">
            <label for="coach_name" class="form-label">Coach Name</label>
            <input type="text" name="coach_name" class="form-control">
        </div>

        <div class="mb-3">
            <label for="contact_number" class="form-label">Contact Number</label>
            <input type="text" name="contact_number" class="form-control">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Sports/Game Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary w-100">Add Sports/Game</button>
    </form>
</div>
@endsection
