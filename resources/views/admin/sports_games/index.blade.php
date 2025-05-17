@extends('layouts.admin')

@section('title', 'Sports & Games')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4 text-primary">Sports & Games</h2>
    <a href="{{ route('admin.sports_games.create') }}" class="btn btn-success mb-4">+ Add Sports/Game</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($sports as $sport)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-lg rounded-4 border-0">
                @if($sport->image_url)
                    <img src="{{ $sport->image_url }}" class="card-img-top rounded-top-4" alt="{{ $sport->title }}">
                @else
                    <div class="card-img-top rounded-top-4 bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                        No Image
                    </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title text-primary">{{ $sport->title }}</h5>
                    <p>{{ Str::limit($sport->description, 100) }}</p>
                    <a href="{{ route('admin.sports_games.edit', $sport->id) }}" class="btn btn-warning btn-sm w-100 mb-2">Edit</a>
                    <form action="{{ route('admin.sports_games.destroy', $sport->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?')" class="w-100">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm w-100">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
