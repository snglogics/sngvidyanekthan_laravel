@extends('layouts.admin')

@section('title', 'Teachers Accolades')

@section('content')
<div class="container mt-4">
    <h2>Teachers Accolades</h2>
    <a href="{{ route('admin.teachers_accolades.create') }}" class="btn btn-primary mb-3">Add New Accolade</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Teacher Name</th>
                <th>Title</th>
                <th>Year</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($accolades as $accolade)
            <tr>
                <td>{{ $accolade->id }}</td>
                <td>{{ $accolade->teacher_name }}</td>
                <td>{{ $accolade->title }}</td>
                <td>{{ $accolade->year }}</td>
                <td>
                    @if($accolade->image_url)
                        <img src="{{ $accolade->image_url }}" alt="{{ $accolade->title }}" width="100">
                    @else
                        <img src="https://via.placeholder.com/100" alt="No Image Available">
                    @endif
                </td>
                <td>
                    <!-- <a href="{{ route('admin.teachers_accolades.show', $accolade->id) }}" class="btn btn-info btn-sm">View</a> -->
                    <a href="{{ route('admin.teachers_accolades.edit', $accolade->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.teachers_accolades.destroy', $accolade) }}" method="POST" style="display:inline-block;">

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
