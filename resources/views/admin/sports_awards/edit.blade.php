@extends('layouts.admin')

@section('title', 'Edit Sports Award')

@section('content')
<div class="container mt-4">
    <h2>Edit Sports Award</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.sports_awards.update', $sportsAward->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $sportsAward->title }}" required>
        </div>

        <div class="mb-3">
            <label for="award_year" class="form-label">Award Year</label>
            <input type="text" name="award_year" id="award_year" class="form-control" value="{{ $sportsAward->award_year }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ $sportsAward->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            @if($sportsAward->image_url)
                <img src="{{ $sportsAward->image_url }}" alt="{{ $sportsAward->title }}" width="150" class="mb-2">
            @endif
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Award</button>
    </form>
</div>
@endsection
