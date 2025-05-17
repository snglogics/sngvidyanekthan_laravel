@extends('layouts.admin')

@section('title', 'Sports Awards')

@section('content')
<div class="container mt-4">
    <h2>Sports Awards</h2>
    <a href="{{ route('admin.sports_awards.create') }}" class="btn btn-primary mb-3">Add New Award</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Award Year</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($awards as $award)
            <tr>
                <td>{{ $award->id }}</td>
                <td>{{ $award->title }}</td>
                <td>{{ $award->award_year }}</td>
                <td>
                    @if($award->image_url)
                        <img src="{{ $award->image_url }}" alt="{{ $award->title }}" width="100">
                    @else
                        No Image
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.sports_awards.show', $award->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('admin.sports_awards.edit', $award->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.sports_awards.destroy', $award->id) }}" method="POST" style="display:inline-block;">
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
