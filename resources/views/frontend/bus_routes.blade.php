@extends('layouts.layout')

@section('title', 'School Bus Routes')

@section('styles')
<style>
    .routes-container {
        background-color: #f8f9fa;
        padding: 50px 0;
    }

    .route-card {
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: all 0.3s ease-in-out;
        margin-bottom: 30px;
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .route-card .route-image {
        width: 100%;
        height: 250px;
        border-radius: 15px 15px 0 0;
        object-fit: cover;
        transition: all 0.3s ease-in-out;
    }

    .route-card .route-details {
        padding: 20px;
        flex: 1;
        position: relative;
    }

    .route-card .route-details h3 {
        color: #007bff;
        font-weight: bold;
        margin-bottom: 10px;
        font-size: 24px;
    }

    .route-card .route-details h5 {
        color: #555;
        font-weight: bold;
        margin-bottom: 10px;
        font-size: 18px;
    }

    .route-card .route-details p {
        color: #777;
        font-size: 16px;
        margin-bottom: 15px;
    }

    .route-card .view-route-btn {
        background-color: #007bff;
        color: #fff;
        padding: 10px 30px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
        display: inline-block;
        margin-top: 15px;
        font-size: 16px;
    }

    .route-card .view-route-btn:hover {
        background-color: #0056b3;
        text-decoration: none;
    }

    .route-card .route-image-placeholder {
        width: 100%;
        height: 250px;
        background-image: url('/frontend/images/bus1.jpg');
        background-size: cover;
        background-position: center;
        border-radius: 15px 15px 0 0;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 80px;
        opacity: 0.8;
    }

    .stops-list {
        list-style-type: none;
        padding: 0;
        margin: 20px 0;
    }

    .stops-list li {
        background-color: #f8f9fa;
        border-radius: 10px;
        margin-bottom: 10px;
        padding: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        font-size: 16px;
        color: #555;
        display: flex;
        align-items: center;
    }

    .stops-list li i {
        color: #007bff;
        margin-right: 15px;
        font-size: 22px;
    }

    .filter-container {
        margin-bottom: 30px;
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .filter-container select,
    .filter-container button {
        flex: 1;
        max-width: 200px;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
        font-weight: bold;
        cursor: pointer;
    }

    .filter-container button {
        background-color: #007bff;
        color: #fff;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
    }

    .filter-container button:hover {
        background-color: #0056b3;
    }
</style>
@endsection

@section('content')
<section class="routes-container">
    <div class="container">
        <h2 class="text-center text-primary fw-bold mb-5" data-aos="fade-down">School Bus Routes</h2>

        <!-- Filter Form -->
        <form id="filter-form" method="GET" action="{{ route('frontend.bus_routes') }}" class="filter-container">
            <select name="route_name" id="route_name" onchange="document.getElementById('filter-form').submit()">
                <option value="">All Routes</option>
                @foreach($route_names as $route_name)
                    <option value="{{ $route_name }}" {{ request('route_name') == $route_name ? 'selected' : '' }}>
                        {{ $route_name }}
                    </option>
                @endforeach
            </select>

            <select name="bus_number" id="bus_number" onchange="document.getElementById('filter-form').submit()">
                <option value="">All Buses</option>
                @foreach($bus_numbers as $bus_number)
                    <option value="{{ $bus_number }}" {{ request('bus_number') == $bus_number ? 'selected' : '' }}>
                        {{ $bus_number }}
                    </option>
                @endforeach
            </select>

            <button type="submit">Filter</button>
        </form>

        <div class="row">
            @forelse($routes as $route)
            <div class="col-md-6 col-lg-4">
                <div class="route-card" data-aos="fade-up">
                    @if($route->bus_image_url)
                        <img src="{{ $route->bus_image_url }}" alt="{{ $route->route_name }}" class="route-image">
                    @else
                        <div class="route-image-placeholder">
                            <i class="fas fa-bus"></i>
                        </div>
                    @endif

                    <div class="route-details">
                        <h3>{{ $route->route_name }}</h3>
                        <h5>Bus Number: {{ $route->bus_number }}</h5>
                        <p><i class="fas fa-user"></i> Driver: {{ $route->driver_name }}</p>
                        <p><i class="fas fa-phone"></i> Contact: {{ $route->driver_contact }}</p>
                        <p><i class="fas fa-info-circle"></i> Description: {{ $route->description }}</p>

                        <ul class="stops-list">
                            @foreach(json_decode($route->stops, true) as $stop)
                                <li><i class="fas fa-map-marker-alt"></i> {{ $stop }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @empty
            <p>No bus routes found.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
</script>
@endsection
