@extends('layouts.admin')

@section('title', 'Add Sports & Game')
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
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="form-section">
        <h2 class="title"><i class="fas fa-futbol"></i> Add Sports & Game</h2>

        <form action="{{ route('admin.sports_games.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label"><i class="fas fa-heading"></i> Title</label>
                <input type="text" name="title" class="form-control" placeholder="Enter title" required>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label"><i class="fas fa-list-alt"></i> Category</label>
                <input type="text" name="category" class="form-control" placeholder="e.g. Indoor, Outdoor, Team Game" required>
            </div>

            <div class="mb-3">
                <label for="coach_name" class="form-label"><i class="fas fa-user"></i> Coach Name</label>
                <input type="text" name="coach_name" class="form-control" placeholder="Enter coach's name">
            </div>

            <div class="mb-3">
                <label for="contact_number" class="form-label"><i class="fas fa-phone-alt"></i> Contact Number</label>
                <input type="text" name="contact_number" class="form-control" placeholder="Enter contact number">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label"><i class="fas fa-align-left"></i> Description</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Describe the sport or game" required></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label"><i class="fas fa-image"></i> Sports/Game Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">
                <i class="fas fa-plus-circle me-1"></i> Add Sports/Game
            </button>
        </form>
    </div>
</div>
@endsection
