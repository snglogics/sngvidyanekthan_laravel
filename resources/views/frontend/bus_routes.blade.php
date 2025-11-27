@extends('layouts.layout')

@section('title', 'School Bus Routes')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .routes-container {
            background-image: url('/frontend/images/parallel18.jpg');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            padding: 50px 0;
            min-height: 100vh;
        }

        .route-card {
            display: grid;
            grid-template-columns: 45% 55%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.25) 0%, rgba(255, 255, 255, 0.15) 100%);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transition: all 0.4s ease;
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .route-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
        }

        .route-card .route-image,
        .route-card .route-image-placeholder {
            width: 100%;
            height: 100%;
            min-height: 250px;
            object-fit: cover;
        }

        .route-card .route-image-placeholder {
            background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 80px;
        }

        .route-card .route-details {
            padding: 25px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: #fff;
        }

        .route-card .route-details h3 {
            color: #fff;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 12px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .route-card .route-details h5 {
            font-size: 18px;
            margin-bottom: 8px;
            font-weight: 600;
            color: #e6f7ff;
        }

        .route-card .route-details p {
            font-size: 16px;
            margin-bottom: 8px;
            color: #e6f7ff;
            display: flex;
            align-items: center;
        }

        .route-card .route-details p i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .route-card .stops-list {
            list-style: none;
            padding: 0;
            margin-top: 15px;
            max-height: 150px;
            overflow-y: auto;
        }

        .route-card .stops-list::-webkit-scrollbar {
            width: 6px;
        }

        .route-card .stops-list::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        .route-card .stops-list::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        .route-card .stops-list li {
            background: rgba(255, 255, 255, 0.15);
            padding: 10px 15px;
            margin-bottom: 8px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .route-card .stops-list li:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateX(5px);
        }

        .route-card .stops-list li i {
            color: #ffd166;
            margin-right: 12px;
            font-size: 16px;
        }

        .filter-container {
            margin-bottom: 40px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 25px;
            backdrop-filter: blur(10px);
        }

        .filter-container select,
        .filter-container button {
            flex: 1;
            min-width: 180px;
            padding: 12px 15px;
            border-radius: 10px;
            border: 1px solid #ddd;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-container select {
            background-color: #fff;
            background-repeat: no-repeat;
            background-position: 12px center;
            background-size: 18px;
            padding-left: 40px;
        }

        #route_name {
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%23333"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 0 1 0-5 2.5 2.5 0 0 1 0 5z"/></svg>');
        }

        #bus_number {
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%23333"><path d="M18 11H6V6h12v5zM4 16c0 .88.39 1.67 1 2.22V20c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h8v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1.78c.61-.55 1-1.34 1-2.22V6c0-3.5-3.58-4-8-4s-8 .5-8 4v10zm3.5 1c-.83 0-1.5-.67-1.5-1.5S6.67 14 7.5 14s1.5.67 1.5 1.5S8.33 17 7.5 17zm9 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/></svg>');
        }

        .filter-container select:focus {
            outline: none;
            border-color: #3a7bd5;
            box-shadow: 0 0 0 3px rgba(58, 123, 213, 0.2);
        }

        .filter-container button {
            background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
            color: #fff;
            font-weight: 600;
            border: none;
            box-shadow: 0 4px 15px rgba(58, 123, 213, 0.3);
        }

        .filter-container button:hover {
            background: linear-gradient(135deg, #2c65b8 0%, #00b8e6 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(58, 123, 213, 0.4);
        }

        .no-routes {
            text-align: center;
            color: #fff;
            font-size: 20px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .route-card {
                grid-template-columns: 40% 60%;
            }
            
            .route-card .route-details {
                padding: 20px;
            }
            
            .route-card .route-details h3 {
                font-size: 22px;
            }
        }

        @media (max-width: 768px) {
            .routes-container {
                padding: 30px 0;
                background-attachment: scroll;
            }
            
            .route-card {
                grid-template-columns: 1fr;
                margin-bottom: 25px;
            }
            
            .route-card .route-image,
            .route-card .route-image-placeholder {
                height: 200px;
                border-radius: 15px 15px 0 0;
            }
            
            .route-card .route-details {
                padding: 20px;
            }
            
            .route-card .route-details h3 {
                font-size: 22px;
            }
            
            .filter-container {
                flex-direction: column;
                padding: 20px;
                gap: 12px;
            }
            
            .filter-container select,
            .filter-container button {
                min-width: 100%;
                max-width: 100%;
            }
        }

        @media (max-width: 576px) {
            .routes-container {
                padding: 20px 0;
            }
            
            .route-card {
                margin-bottom: 20px;
                border-radius: 15px;
            }
            
            .route-card .route-details {
                padding: 15px;
            }
            
            .route-card .route-details h3 {
                font-size: 20px;
            }
            
            .route-card .route-details h5,
            .route-card .route-details p {
                font-size: 15px;
            }
            
            .route-card .stops-list li {
                font-size: 13px;
                padding: 8px 12px;
            }
            
            .filter-container {
                padding: 15px;
                margin-bottom: 30px;
            }
            
            .no-routes {
                font-size: 18px;
                padding: 30px 20px;
            }
        }

        @media (max-width: 480px) {
            .route-card .route-image,
            .route-card .route-image-placeholder {
                height: 180px;
            }
            
            .route-card .route-details h3 {
                font-size: 19px;
            }
            
            .route-card .stops-list {
                max-height: 120px;
            }
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
                    @foreach ($route_names as $route_name)
                        <option value="{{ $route_name }}" {{ request('route_name') == $route_name ? 'selected' : '' }}>
                            {{ $route_name }}
                        </option>
                    @endforeach
                </select>

                <select name="bus_number" id="bus_number" onchange="document.getElementById('filter-form').submit()">
                    <option value="">All Buses</option>
                    @foreach ($bus_numbers as $bus_number)
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
                            @if ($route->bus_image_url)
                                <img src="{{ $route->bus_image_url }}" alt="{{ $route->route_name }}" class="route-image">
                            @else
                                <div class="route-image-placeholder">
                                    <i class="fas fa-bus"></i>
                                </div>
                            @endif

                            <div class="route-details">
                                <div>
                                    <h3>{{ $route->route_name }}</h3>
                                    <h5><i class="fas fa-bus"></i> Bus Number: {{ $route->bus_number }}</h5>
                                    <p><i class="fas fa-user"></i> Driver: {{ $route->driver_name }}</p>
                                    <p><i class="fas fa-phone"></i> Contact: {{ $route->driver_contact }}</p>
                                    <p><i class="fas fa-info-circle"></i> Description: {{ $route->description }}</p>
                                </div>
                                
                                <div>
                                    <h5 style="margin-top: 15px; margin-bottom: 10px;">Bus Stops:</h5>
                                    <ul class="stops-list">
                                        @foreach (json_decode($route->stops, true) as $stop)
                                            <li><i class="fas fa-map-marker-alt"></i> {{ $stop }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="no-routes" data-aos="fade-up">
                            <i class="fas fa-bus-slash" style="font-size: 48px; margin-bottom: 15px;"></i>
                            <p>No bus routes found matching your criteria.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
@endsection