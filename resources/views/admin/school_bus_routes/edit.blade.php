@extends('layouts.admin')

@section('title', 'Edit School Bus Route')

@section('content')
<div class="container mt-4">
    <h2>Edit School Bus Route</h2>

    <form action="{{ route('admin.school_bus_routes.update', $schoolBusRoute->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="route_name" class="form-label">Route Name</label>
            <input type="text" name="route_name" id="route_name" class="form-control" value="{{ $schoolBusRoute->route_name }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ $schoolBusRoute->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="stops" class="form-label">Stops (comma separated)</label>
            <textarea name="stops[]" id="stops" class="form-control" rows="3">{{ implode(',', json_decode($schoolBusRoute->stops, true)) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="driver_name" class="form-label">Driver Name</label>
            <input type="text" name="driver_name" id="driver_name" class="form-control" value="{{ $schoolBusRoute->driver_name }}" required>
        </div>

        <div class="mb-3">
            <label for="driver_contact" class="form-label">Driver Contact</label>
            <input type="text" name="driver_contact" id="driver_contact" class="form-control" value="{{ $schoolBusRoute->driver_contact }}" required>
        </div>

        <div class="mb-3">
            <label for="bus_number" class="form-label">Bus Number</label>
            <input type="text" name="bus_number" id="bus_number" class="form-control" value="{{ $schoolBusRoute->bus_number }}" required>
        </div>

        <div class="mb-3">
            <label for="bus_image" class="form-label">Bus Image</label>
            <input type="file" name="bus_image" id="bus_image" class="form-control">
            @if($schoolBusRoute->bus_image_url)
                <img src="{{ $schoolBusRoute->bus_image_url }}" alt="{{ $schoolBusRoute->route_name }}" width="150" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Route</button>
    </form>
</div>
@endsection
