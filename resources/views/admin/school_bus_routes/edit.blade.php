@extends('layouts.admin')

@section('title', 'Edit School Bus Route')
@section('breadcrumb-title', 'Edit Bus Route')
@section('breadcrumb-link', route('admin.school_bus_routes.index'))

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
@endsection

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white d-flex align-items-center">
            <i class="fas fa-bus-alt me-2"></i>
            <h5 class="mb-0">Edit School Bus Route</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.school_bus_routes.update', $schoolBusRoute->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="route_name" class="form-label fw-semibold">
                            <i class="fas fa-road me-1 text-primary"></i> Route Name
                        </label>
                        <input type="text" name="route_name" id="route_name" class="form-control" value="{{ $schoolBusRoute->route_name }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="bus_number" class="form-label fw-semibold">
                            <i class="fas fa-id-badge me-1 text-primary"></i> Bus Number
                        </label>
                        <input type="text" name="bus_number" id="bus_number" class="form-control" value="{{ $schoolBusRoute->bus_number }}" required>
                    </div>

                    <div class="col-md-12">
                        <label for="description" class="form-label fw-semibold">
                            <i class="fas fa-align-left me-1 text-primary"></i> Description
                        </label>
                        <textarea name="description" id="description" class="form-control" rows="3">{{ $schoolBusRoute->description }}</textarea>
                    </div>

                    <div class="col-md-12">
                        <label for="stops" class="form-label fw-semibold">
                            <i class="fas fa-map-marker-alt me-1 text-primary"></i> Stops (comma separated)
                        </label>
                        <textarea name="stops[]" id="stops" class="form-control" rows="2">{{ implode(',', json_decode($schoolBusRoute->stops, true)) }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label for="driver_name" class="form-label fw-semibold">
                            <i class="fas fa-user me-1 text-primary"></i> Driver Name
                        </label>
                        <input type="text" name="driver_name" id="driver_name" class="form-control" value="{{ $schoolBusRoute->driver_name }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="driver_contact" class="form-label fw-semibold">
                            <i class="fas fa-phone-alt me-1 text-primary"></i> Driver Contact
                        </label>
                        <input type="text" name="driver_contact" id="driver_contact" class="form-control" value="{{ $schoolBusRoute->driver_contact }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="bus_image" class="form-label fw-semibold">
                            <i class="fas fa-image me-1 text-primary"></i> Bus Image
                        </label>
                        <input type="file" name="bus_image" id="bus_image" class="form-control">
                    </div>

                    <div class="col-md-6">
                        @if($schoolBusRoute->bus_image_url)
                            <label class="form-label fw-semibold d-block">
                                <i class="fas fa-eye me-1 text-primary"></i> Current Image
                            </label>
                            <img src="{{ $schoolBusRoute->bus_image_url }}" alt="{{ $schoolBusRoute->route_name }}" class="img-thumbnail rounded" width="150">
                        @endif
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="fas fa-save me-1"></i> Update Route
                        </button>
                        <a href="{{ route('admin.school_bus_routes.index') }}" class="btn btn-secondary ms-2">
                            <i class="fas fa-arrow-left me-1"></i> Back to List
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
