@extends('layouts.admin')

@section('title', 'Bus Route Details')

@section('styles')
<style>
    .route-details-container {
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
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
        font-size: 28px;
    }

    .route-header h4 {
        color: #555;
        font-weight: bold;
        margin-bottom: 20px;
        font-size: 20px;
    }

    .route-image {
        width: 100%;
        max-width: 600px;
        margin: 0 auto 30px auto;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .stops-list {
        list-style-type: none;
        padding: 0;
    }

    .stops-list li {
        background-color: #f8f9fa;
        border-radius: 10px;
        margin-bottom: 10px;
        padding: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        font-size: 16px;
        color: #555;
    }

    .stops-list li i {
        color: #007bff;
        margin-right: 15px;
        font-size: 22px;
    }

    #map {
        width: 100%;
        height: 400px;
        border-radius: 15px;
        margin-bottom: 30px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="route-details-container">
        <div class="route-header">
            <h2>{{ $schoolBusRoute->route_name }}</h2>
            <h4>Bus Number: {{ $schoolBusRoute->bus_number }}</h4>

            @if($schoolBusRoute->bus_image_url)
                <img src="{{ $schoolBusRoute->bus_image_url }}" alt="{{ $schoolBusRoute->route_name }}" class="route-image">
            @endif
        </div>

        <ul class="stops-list">
            @foreach(json_decode($schoolBusRoute->stops, true) as $stop)
                <li>
                    <i class="fas fa-map-marker-alt"></i> {{ $stop }}
                </li>
            @endforeach
        </ul>

        <div id="map"></div>

        <div class="route-header">
            <h4>Driver: {{ $schoolBusRoute->driver_name }}</h4>
            <h4>Contact: {{ $schoolBusRoute->driver_contact }}</h4>
        </div>
    </div>
</div>
@endsection



