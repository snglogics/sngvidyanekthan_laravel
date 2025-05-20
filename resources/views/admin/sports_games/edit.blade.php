@extends('layouts.admin')

@section('title', 'Edit Sports & Game')
@section('breadcrumb-title', 'Student Life')
@section('breadcrumb-link', route('admin.studentlife'))

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    .form-section {
        background: #fff;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        max-width: 750px;
        margin: 0 auto;
    }

    .form-label i {
        margin-right: 8px;
        color: #007bff;
    }

    .btn-primary {
        border-radius: 10px;
        font-weight: bold;
        background-color: #007bff;
    }

    h2.title {
        font-weight: 600;
        color: #343a40;
        text-align: center;
        margin-bottom: 30px;
    }

    .image-preview {
        max-width: 200px;
        border-radius: 10px;
        margin-top: 10px;
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="form-section">
        <h2 class="title"><i class="fas fa-pen-to-square"></i> Edit Sports & Game</h2>

        <form action="{{ route('admin.sports_games.update', $sportsGame->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label"><i class="fas fa-heading"></i> Title</label>
                <input type="text" name="title" class="form-control" value="{{ $sportsGame->title }}" required>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label"><i class="fas fa-list-alt"></i> Category</label>
                <input type="text" name="category" class="form-control" value="{{ $sportsGame->category }}" required>
            </div>

            <div class="mb-3">
                <label for="coach_name" class="form-label"><i class="fas fa-user"></i> Coach Name</label>
                <input type="text" name="coach_name" class="form-control" value="{{ $sportsGame->coach_name }}">
            </div>

            <div class="mb-3">
                <label for="contact_number" class="form-label"><i class="fas fa-phone"></i> Contact Number</label>
                <input type="text" name="contact_number" class="form-control" value="{{ $sportsGame->contact_number }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label"><i class="fas fa-align-left"></i> Description</label>
                <textarea name="description" class="form-control" rows="4" required>{{ $sportsGame->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label"><i class="fas fa-image"></i> Sports/Game Image</label>
                <input type="file" name="image" class="form-control">

                @if($sportsGame->image_url)
                    <div>
                        <img src="{{ $sportsGame->image_url }}" alt="Current Image" class="image-preview">
                        <small class="text-muted d-block">Current Image</small>
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">
                <i class="fas fa-save me-1"></i> Update Sports/Game
            </button>
        </form>
    </div>
</div>
@endsection
