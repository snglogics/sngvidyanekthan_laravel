@extends('layouts.admin')

@section('title', 'School Bus Routes')

@section('content')
<div class="container mt-4">
    <h2>School Bus Routes</h2>
    <a href="{{ route('admin.school_bus_routes.create') }}" class="btn btn-primary mb-3">Add New Route</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Route Name</th>
                <th>Bus Number</th>
                <th>Driver Name</th>
                <th>Driver Contact</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($routes as $route)
            <tr>
                <td>{{ $route->id }}</td>
                <td>{{ $route->route_name }}</td>
                <td>{{ $route->bus_number }}</td>
                <td>{{ $route->driver_name }}</td>
                <td>{{ $route->driver_contact }}</td>
                <td>
                    <a href="{{ route('admin.school_bus_routes.show', $route->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('admin.school_bus_routes.edit', $route->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.school_bus_routes.destroy', $route->id) }}" method="POST" style="display:inline-block;">
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
