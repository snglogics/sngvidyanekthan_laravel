@extends('layouts.layout')

@section('title', 'Sports Awards')



@section('styles')
<style>
    .awards-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .award-card {
        background-color: #ffffff;
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        transition: all 0.3s ease-in-out;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .award-card img {
        width: 100%;
        border-radius: 20px 20px 0 0;
        height: 200px;
        object-fit: cover;
        transition: all 0.3s ease-in-out;
    }

    .award-card img:hover {
        transform: scale(1.05);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }

    .award-card h3 {
        padding: 15px;
        font-size: 22px;
        color: #007bff;
        margin: 0;
        text-align: center;
        position: relative;
    }

    .award-card p {
        padding: 0 15px 15px;
        color: #555;
        text-align: center;
        font-weight: 600;
    }

    .award-card .icon-overlay {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: #007bff;
        color: #fff;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        transition: all 0.3s ease-in-out;
        z-index: 10;
    }

    .award-card .icon-overlay:hover {
        background-color: #0056b3;
        transform: rotate(360deg);
    }

    .award-card .award-details {
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 0 0 20px 20px;
        text-align: center;
        transition: all 0.3s ease-in-out;
    }

    .award-card:hover .award-details {
        background-color: #007bff;
        color: #fff;
    }

    .award-card .award-details a {
        color: #007bff;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease-in-out;
    }

    .award-card .award-details a:hover {
        color: #fff;
    }

    .filter-container {
        margin-bottom: 20px;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .filter-container input,
    .filter-container select,
    .filter-container button {
        flex: 1;
        max-width: 200px;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
        margin-bottom: 10px;
    }

    .filter-container button {
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
        font-weight: bold;
    }

    .filter-container button:hover {
        background-color: #0056b3;
    }

    .award-card .award-year {
        background-color: #f39c12;
        color: #fff;
        border-radius: 0 0 20px 20px;
        padding: 5px 15px;
        position: absolute;
        bottom: 0;
        left: 0;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
    }

    .award-card:hover .award-year {
        background-color: #e67e22;
    }
</style>
@endsection


@section('content')
<div class="container">
    <h2 class="mb-4">🏆 Sports Awards</h2>

    <!-- Filter Section -->
    <form method="GET" action="{{ route('frontend.sports_awards.index') }}" class="filter-container">
        <input type="text" name="search" placeholder="Search by title..." value="{{ request('search') }}">
        <select name="year">
            <option value="">All Years</option>
            @foreach($years as $year)
                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
            @endforeach
        </select>
        <button type="submit">Filter</button>
    </form>

    <!-- Awards Cards -->
    <div class="awards-container">
        @forelse($awards as $award)
            <div class="award-card" data-aos="fade-up">
                <!-- Image Section -->
                @if($award->image_url)
                    <img src="{{ $award->image_url }}" alt="{{ $award->title }}">
                @else
                    <img src="https://via.placeholder.com/300x200" alt="No Image Available">
                @endif

                <!-- Icon Overlay -->
                <div class="icon-overlay">
                    <i class="fas fa-trophy"></i>
                </div>

                <!-- Award Details -->
                <div class="award-details">
                    <h3>{{ $award->title }}</h3>
                    <p>{{ $award->award_year }}</p>
                    <a href="{{ route('frontend.sports_awards.show', $award->id) }}">
                        <i class="fas fa-info-circle"></i> View Details
                    </a>
                </div>

                <!-- Award Year Ribbon -->
                <div class="award-year">
                    <i class="fas fa-calendar-alt"></i> {{ $award->award_year }}
                </div>
            </div>
        @empty
            <p>No awards found.</p>
        @endforelse
    </div>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $awards->links() }}
    </div>
</div>
@endsection
