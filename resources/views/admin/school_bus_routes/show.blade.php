@extends('layouts.admin')

@section('title', 'Bus Route Details')
@section('breadcrumb-title', 'School Bus Routes')
@section('breadcrumb-link', route('admin.school_bus_routes.index'))

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
    .route-details-container {
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
        padding: 30px;
        margin-bottom: 30px;
    }

    .route-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .route-header h2 {
        color: #007bff;
        font-weight: bold;
        margin-bottom: 10px;
        font-size: 30px;
    }

    .route-header h4 {
        color: #444;
        font-weight: 500;
        margin-bottom: 10px;
        font-size: 18px;
    }

    .route-image {
        width: 100%;
        max-width: 600px;
        margin: 0 auto 30px auto;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .stops-list {
        list-style-type: none;
        padding-left: 0;
    }

    .stops-list li {
        background-color: #f8f9fa;
        border-left: 5px solid #007bff;
        border-radius: 10px;
        margin-bottom: 10px;
        padding: 12px 20px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        font-size: 16px;
        color: #333;
    }

    .stops-list li i {
        color: #007bff;
        margin-right: 15px;
        font-size: 20px;
    }

    #map {
        width: 100%;
        height: 400px;
        border-radius: 15px;
        margin-bottom: 30px;
        background-color: #e9ecef;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="route-details-container">
        <div class="route-header">
            <h2><i class="fas fa-route me-2"></i>{{ $schoolBusRoute->route_name }}</h2>
            <h4><i class="fas fa-bus me-2"></i>Bus Number: {{ $schoolBusRoute->bus_number }}</h4>

            @if($schoolBusRoute->bus_image_url)
                <img src="{{ $schoolBusRoute->bus_image_url }}" alt="{{ $schoolBusRoute->route_name }}" class="route-image img-fluid">
            @else
                <p class="text-muted"><i class="fas fa-image-slash me-1"></i>No image available for this route.</p>
            @endif
        </div>

        <div class="mb-4">
            <h5 class="mb-3"><i class="fas fa-map-marked-alt me-2"></i>Stops</h5>
            <ul class="stops-list">
                @forelse(json_decode($schoolBusRoute->stops, true) as $stop)
                    <li><i class="fas fa-map-marker-alt"></i>{{ $stop }}</li>
                @empty
                    <li><i class="fas fa-info-circle text-warning"></i>No stops defined.</li>
                @endforelse
            </ul>
        </div>

        {{-- Optional map section --}}
        <div id="map">
            <!-- You can initialize a Leaflet/Google map here if needed -->
            <p class="text-center text-muted pt-5"><i class="fas fa-map me-1"></i>Map view will be displayed here</p>
        </div>

        <div class="route-header mt-4">
            <h4><i class="fas fa-user me-2"></i>Driver: {{ $schoolBusRoute->driver_name }}</h4>
            <h4><i class="fas fa-phone me-2"></i>Contact: {{ $schoolBusRoute->driver_contact }}</h4>
        </div>
    </div>
</div>
@endsection
