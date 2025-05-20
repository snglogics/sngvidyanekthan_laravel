@extends('layouts.admin')

@section('title', 'Edit Sports Award')
@section('breadcrumb-title', 'Achievements')
@section('breadcrumb-link', route('admin.achievements'))

@section('styles')
<style>
    .form-container {
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-bottom: 30px;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }

    .form-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .form-header h2 {
        color: #28a745;
        font-weight: bold;
        font-size: 28px;
    }

    .form-label {
        font-weight: bold;
        color: #333;
    }

    .btn-primary {
        padding: 10px 25px;
        font-size: 16px;
        border-radius: 8px;
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-primary:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .form-control:focus {
        box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
        border-color: #28a745;
    }

    .alert ul {
        margin-bottom: 0;
    }

    .image-preview {
        display: block;
        margin-bottom: 15px;
        border-radius: 10px;
        border: 1px solid #ddd;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
@endsection

@section('content')
<div class="container mt-4">
    <div class="form-container">
        <div class="form-header">
            <h2><i class="fas fa-edit me-2"></i>Edit Sports Award</h2>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li><i class="fas fa-exclamation-circle text-danger me-1"></i>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.sports_awards.update', $sportsAward->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label"><i class="fas fa-trophy me-1 text-primary"></i>Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $sportsAward->title }}" required>
            </div>

            <div class="mb-3">
                <label for="award_year" class="form-label"><i class="fas fa-calendar-alt me-1 text-primary"></i>Award Year</label>
                <input type="text" name="award_year" id="award_year" class="form-control" value="{{ $sportsAward->award_year }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label"><i class="fas fa-align-left me-1 text-primary"></i>Description</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ $sportsAward->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label"><i class="fas fa-image me-1 text-primary"></i>Image</label>
                @if($sportsAward->image_url)
                    <img src="{{ $sportsAward->image_url }}" alt="{{ $sportsAward->title }}" width="150" class="image-preview">
                @endif
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Update Award
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
