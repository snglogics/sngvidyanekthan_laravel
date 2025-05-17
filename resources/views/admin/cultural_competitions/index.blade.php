@extends('layouts.admin')

@section('title', 'Cultural Competitions')

@section('content')
<div class="container mt-4">
    <h2>Cultural Competitions</h2>
    <a href="{{ route('admin.cultural_competitions.create') }}" class="btn btn-primary mb-3">Add New Competition</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Year</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($competitions as $competition)
            <tr>
                <td>{{ $competition->id }}</td>
                <td>{{ $competition->title }}</td>
                <td>{{ $competition->competition_year }}</td>
                <td>
                    @if($competition->image_url)
                        <img src="{{ $competition->image_url }}" alt="{{ $competition->title }}" width="100">
                    @else
                        <img src="https://via.placeholder.com/100" alt="No Image Available">
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.cultural_competitions.show', $competition->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('admin.cultural_competitions.edit', $competition->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.cultural_competitions.destroy', $competition->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
