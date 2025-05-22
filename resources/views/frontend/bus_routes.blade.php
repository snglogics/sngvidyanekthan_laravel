@extends('layouts.layout')

@section('title', 'School Bus Routes')

@section('styles')
<style>
    .routes-container {
        background-image: url('/frontend/images/parallel18.jpg');
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
        padding: 50px 0;
    }

    .route-card {
        display: grid;
        grid-template-columns: 45% 55%;
        background-color: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
        margin-bottom: 30px;
    }

    .route-card:hover {
        transform: translateY(-5px);
    }

    .route-card .route-image,
    .route-card .route-image-placeholder {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .route-card .route-image-placeholder {
        background-image: url('/frontend/images/bus1.jpg');
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 80px;
        opacity: 0.8;
    }

    .route-card .route-details {
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .route-card .route-details h3 {
        color: #007bff;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .route-card .route-details h5,
    .route-card .route-details p {
        font-size: 16px;
        margin-bottom: 6px;
        color: #fff;
    }

    .route-card .stops-list {
        list-style: none;
        padding: 0;
        margin-top: 10px;
    }

    .route-card .stops-list li {
        background-color: rgba(255, 255, 255, 0.15);
        padding: 8px 12px;
        margin-bottom: 8px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        font-size: 14px;
        color: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .route-card .stops-list li i {
        color: #fff;
        margin-right: 10px;
    }

    @media (max-width: 768px) {
        .route-card {
            grid-template-columns: 1fr;
        }

        .route-card .route-image,
        .route-card .route-image-placeholder {
            height: 200px;
            border-radius: 15px 15px 0 0;
        }

        .route-card .route-details {
            padding: 15px;
        }
    }

    .filter-container {
        margin-bottom: 30px;
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        background-color: rgba(255, 255, 255, 0.9);
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

@section('hero_title', 'School Bus Routes')

@section('content')
<section class="routes-container">
    <div class="container">
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
                <div class="col-md-12 col-lg-6">
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
