@extends('layouts.admin')

@section('title', 'Add School Bus Route')

@section('content')
<div class="container mt-4">
    <h2>Add School Bus Route</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.school_bus_routes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="route_name" class="form-label">Route Name</label>
            <input type="text" name="route_name" id="route_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label for="stops" class="form-label">Stops (comma separated)</label>
            <textarea name="stops[]" id="stops" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="driver_name" class="form-label">Driver Name</label>
            <input type="text" name="driver_name" id="driver_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="driver_contact" class="form-label">Driver Contact</label>
            <input type="text" name="driver_contact" id="driver_contact" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="bus_number" class="form-label">Bus Number</label>
            <input type="text" name="bus_number" id="bus_number" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="bus_image" class="form-label">Bus Image</label>
            <input type="file" name="bus_image" id="bus_image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Add Route</button>
    </form>
</div>
@endsection
