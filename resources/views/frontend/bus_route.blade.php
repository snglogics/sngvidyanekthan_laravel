@extends('layouts.layout')

@section('title', 'School Bus Routes')

@section('styles')
    <style>
        /* Enhanced Background & Container */
        .routes-container {
            background: linear-gradient(135deg, 
                rgba(25, 65, 120, 0.9) 0%, 
                rgba(15, 45, 85, 0.95) 50%, 
                rgba(5, 25, 55, 0.9) 100%),
                url('/frontend/images/parallel18.jpg') no-repeat center center/cover;
            background-attachment: fixed;
            padding: 40px 0;
            min-height: 100vh;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
        }

        /* Filter Section */
        .filter-container {
            margin-bottom: 40px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 25px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .filter-container select {
            flex: 1;
            min-width: 250px;
            padding: 12px 20px;
            border-radius: 12px;
            border: 2px solid #e3f2fd;
            font-weight: 600;
            font-size: 16px;
            background: linear-gradient(135deg, #ffffff 0%, #f8fdff 100%);
            color: #2c3e50;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.1);
        }

        .filter-container select:focus {
            outline: none;
            border-color: #2196f3;
            box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.2);
            transform: translateY(-2px);
        }

        .filter-label {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .filter-label i {
            color: #2196f3;
            font-size: 18px;
        }

        /* Enhanced Route Cards - Fixed Layout */
        .route-card {
            display: grid;
            grid-template-columns: 100%;
            background: linear-gradient(135deg, 
                rgba(255, 255, 255, 0.25) 0%, 
                rgba(255, 255, 255, 0.15) 100%);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            max-width: 100%;
            height: auto;
        }

        .route-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #2196f3, #00bcd4, #4caf50);
            z-index: 2;
        }

        .route-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
        }

        /* Bus Icon Section */
        .bus-icon-section {
            background: linear-gradient(135deg, #2196f3 0%, #1976d2 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px 15px;
            position: relative;
            overflow: hidden;
            min-height: 200px;
        }

        .bus-icon-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%) rotate(45deg); }
            100% { transform: translateX(100%) rotate(45deg); }
        }

        .bus-icon {
            font-size: 40px;
            color: white;
            margin-bottom: 10px;
            z-index: 1;
        }

        .bus-number {
            font-size: 24px;
            font-weight: 800;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            z-index: 1;
        }

        /* Route Details */
        .route-details {
            padding: 25px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            min-height: 200px;
        }

        .route-header {
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
            padding-bottom: 15px;
            margin-bottom: 10px;
        }

        .route-header h3 {
            color: #ffffff;
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 8px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .staff-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 10px;
        }

        .staff-card {
            background: rgba(255, 255, 255, 0.1);
            padding: 12px 15px;
            border-radius: 12px;
            border-left: 4px solid #4caf50;
        }

        .staff-card.attender {
            border-left-color: #ff9800;
        }

        .staff-role {
            font-size: 12px;
            color: #bbdefb;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .staff-name {
            font-size: 16px;
            font-weight: 600;
            color: white;
            margin-bottom: 2px;
        }

        .staff-phone {
            font-size: 14px;
            color: #e3f2fd;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Stops List */
        .stops-section {
            background: rgba(255, 255, 255, 0.08);
            border-radius: 15px;
            padding: 20px;
        }

        .stops-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stops-header h5 {
            color: #ffffff;
            font-size: 16px;
            font-weight: 600;
            margin: 0;
        }

        .stops-header i {
            color: #ff5252;
        }

        .stops-list {
            list-style: none;
            padding: 0;
            margin: 0;
            max-height: 250px;
            overflow-y: auto;
        }

        .stops-list::-webkit-scrollbar {
            width: 6px;
        }

        .stops-list::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        .stops-list::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #2196f3, #00bcd4);
            border-radius: 10px;
        }

        .stop-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255, 255, 255, 0.12);
            padding: 12px 15px;
            margin-bottom: 8px;
            border-radius: 10px;
            transition: all 0.3s ease;
            border-left: 3px solid #ff5252;
        }

        .stop-item:hover {
            background: rgba(255, 255, 255, 0.18);
            transform: translateX(5px);
        }

        .stop-name {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
            color: #ffffff;
            flex: 1;
        }

        .stop-name i {
            color: #ff5252;
            font-size: 14px;
        }

        .stop-times {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .time-slot {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            min-width: 100px;
            justify-content: center;
        }

        .morning {
            background: linear-gradient(135deg, #4caf50, #45a049);
            color: white;
            box-shadow: 0 2px 8px rgba(76, 175, 80, 0.3);
        }

        .evening {
            background: linear-gradient(135deg, #ff9800, #f57c00);
            color: white;
            box-shadow: 0 2px 8px rgba(255, 152, 0, 0.3);
        }

        .time-slot i {
            font-size: 12px;
        }

        /* Empty State */
        .no-routes {
            text-align: center;
            color: white;
            padding: 60px 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            backdrop-filter: blur(10px);
        }

        .no-routes i {
            font-size: 60px;
            margin-bottom: 20px;
            color: #bbdefb;
        }

        .no-routes h4 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        /* Responsive Design - Fixed for Large Screens */
        @media (min-width: 1400px) {
            .container {
                max-width: 1400px;
            }
            
            .col-lg-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }
            
            .route-card {
                height: 100%;
                min-height: 400px;
            }
        }

        @media (max-width: 1399px) {
            .container {
                max-width: 1320px;
            }
        }

        @media (max-width: 1199px) {
            .container {
                max-width: 1140px;
            }
        }

        @media (max-width: 768px) {
            .route-card {
                grid-template-columns: 1fr;
            }

            .bus-icon-section {
                flex-direction: row;
                justify-content: flex-start;
                gap: 15px;
                padding: 15px 20px;
                min-height: 100px;
            }

            .bus-icon {
                font-size: 32px;
                margin-bottom: 0;
            }

            .bus-number {
                font-size: 20px;
            }

            .route-details {
                padding: 20px;
                min-height: auto;
            }

            .staff-info {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .stop-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .stop-times {
                width: 100%;
                justify-content: space-between;
            }

            .filter-container {
                flex-direction: column;
                padding: 20px;
            }

            .filter-container select {
                min-width: 100%;
            }
        }

        @media (max-width: 576px) {
            .routes-container {
                padding: 20px 0;
            }

            .route-details {
                padding: 15px;
            }

            .time-slot {
                min-width: 80px;
                font-size: 12px;
                padding: 4px 8px;
            }

            .stop-name {
                font-size: 14px;
            }
        }

        /* Animation for cards */
        .route-card {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Ensure proper card spacing */
        .row {
            margin: 0 -15px;
        }

        .col-12, .col-lg-6 {
            padding: 0 15px;
        }
    </style>
@endsection

@section('hero_title', 'School Bus Routes')

@section('content')
    <section class="routes-container">
        <div class="container">
            <!-- Enhanced Filter Form -->
            <form id="filter-form" method="GET" action="{{ route('frontend.bus_routes') }}" class="filter-container">
                <div style="flex: 1; min-width: 300px;">
                    <div class="filter-label">
                        <i class="fas fa-bus"></i>
                        <span>Select Bus Number</span>
                    </div>
                    <select name="bus_no" id="bus_no" onchange="document.getElementById('filter-form').submit()">
                        <option value="">All Buses</option>
                        @php
                            // Sort bus numbers numerically instead of alphabetically
                            $sortedBusNumbers = collect($bus_numbers)->sort(function($a, $b) {
                                return intval($a) - intval($b);
                            });
                        @endphp
                        @foreach ($sortedBusNumbers as $bus_number)
                            <option value="{{ $bus_number }}" {{ request('bus_no') == $bus_number ? 'selected' : '' }}>
                                Bus {{ $bus_number }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>

            <div class="row">
                @php
                    // Sort buses numerically by bus number
                    $sortedBuses = $buses->sortBy(function($bus) {
                        return intval($bus->bus_no);
                    });
                @endphp
                
                @forelse($sortedBuses as $bus)
                    <div class="col-12 col-lg-6 mb-4">
                        <div class="route-card" data-aos="fade-up">
                            <!-- Bus Icon Section -->
                            <div class="bus-icon-section">
                                <i class="fas fa-bus bus-icon"></i>
                                <div class="bus-number">#{{ $bus->bus_no }}</div>
                            </div>

                            <!-- Route Details -->
                            <div class="route-details">
                                <div class="route-header">
                                    <h3>Bus Route #{{ $bus->bus_no }}</h3>
                                    
                                    <!-- Staff Information -->
                                    <div class="staff-info">
                                        <div class="staff-card">
                                            <div class="staff-role">Driver</div>
                                            <div class="staff-name">{{ $bus->driver_name }}</div>
                                            <div class="staff-phone">
                                                <i class="fas fa-phone"></i>
                                                {{ $bus->driver_phone }}
                                            </div>
                                        </div>
                                        <div class="staff-card attender">
                                            <div class="staff-role">Attender</div>
                                            <div class="staff-name">{{ $bus->attender_name }}</div>
                                            <div class="staff-phone">
                                                <i class="fas fa-phone"></i>
                                                {{ $bus->attender_phone }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bus Stops -->
                                <div class="stops-section">
                                    <div class="stops-header">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <h5>Bus Stops & Timings</h5>
                                    </div>
                                    <ul class="stops-list">
                                        @foreach ($bus->stops as $stop)
                                            <li class="stop-item">
                                                <div class="stop-name">
                                                    <i class="fas fa-map-pin"></i>
                                                    {{ $stop->stop_name }}
                                                </div>
                                                <div class="stop-times">
                                                    <span class="time-slot morning">
                                                        <i class="fas fa-sun"></i>
                                                        {{ $stop->morning_time }}
                                                    </span>
                                                    <span class="time-slot evening">
                                                        <i class="fas fa-moon"></i>
                                                        {{ $stop->evening_time }}
                                                    </span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="no-routes" data-aos="fade-up">
                            <i class="fas fa-bus-slash"></i>
                            <h4>No Bus Routes Found</h4>
                            <p>Please try selecting a different bus number or check back later.</p>
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
            once: true,
            offset: 50
        });

        // Smooth scrolling for stops list
        document.addEventListener('DOMContentLoaded', function() {
            const stopItems = document.querySelectorAll('.stop-item');
            stopItems.forEach((item, index) => {
                item.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
@endsection