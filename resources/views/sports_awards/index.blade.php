@extends('layouts.layout')

@section('title', 'Sports Awards')

@section('styles')
<style>
   

    .awards-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
        margin-top: 20px;
    }

    .award-card {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        background-color: #fff;
    }

    .award-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s ease;
        border-radius: 20px 20px 0 0;
    }

    .award-card:hover img {
        transform: scale(1.1);
    }

    .award-card::before {
        content: "";
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
        z-index: 1;
        border-radius: 20px;
    }

    .award-card:hover::before {
        opacity: 1;
    }

    .icon-overlay {
        position: absolute;
        top: 15px;
        right: 15px;
        z-index: 2;
        background-color: #007bff;
        color: white;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .award-card:hover .icon-overlay {
        background-color: black;
        transform: rotate(360deg);
    }

    .award-details {
        padding: 20px;
        text-align: center;
        position: relative;
        z-index: 2;
        transition: all 0.3s ease-in-out;
    }

    .award-card:hover .award-details {
        color: white;
    }

    .award-details h3 {
        margin-bottom: 10px;
        font-size: 22px;
        color: inherit;
        transition: color 0.3s ease-in-out;
    }

    .award-details p {
        margin: 0;
        font-weight: bold;
        color: inherit;
    }

    .award-details a {
        display: inline-block;
        margin-top: 10px;
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
        transition: color 0.3s ease-in-out;
    }

    .award-card:hover .award-details a {
        color: #fff;
    }

    .award-year {
        position: absolute;
        bottom: 0;
        left: 0;
        background-color: #f39c12;
        color: #fff;
        padding: 5px 15px;
        border-radius: 0 10px 0 20px;
        font-weight: bold;
        font-size: 14px;
        z-index: 2;
        transition: background-color 0.3s ease-in-out;
    }

    .award-card:hover .award-year {
        background-color: #000;
    }

    .filter-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
        margin-bottom: 30px;
    }

    .filter-container input,
    .filter-container select,
    .filter-container button {
        padding: 10px 15px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 16px;
    }

    .filter-container button {
        background-color:rgb(127, 154, 182);
        color: #fff;
        font-weight: bold;
        transition: background-color 0.3s ease-in-out;
        cursor: pointer;
    }

    .filter-container button:hover {
        background-color: black;
    }

    .mt-4 {
        text-align: center;
    }
</style>
<style>
    .parallax-section {
        background-image: url('/frontend/images/parallel6.jpg');
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        padding: 60px 20px;
    }

    .parallax-overlay {
        background-color: rgba(0, 0, 0, 0.5); /* dark overlay */
        padding: 60px 20px;
        border-radius: 20px;
    }

    .parallax-section h1 {
        color: white;
        text-align: center;
        font-size: 48px;
        font-weight: bold;
        margin-bottom: 30px;
    }
</style>
@endsection
@section('hero_title', '🏆 Sports Awards')
@section('content')
<div class="parallax-section">
    <div class="parallax-overlay">

    

        <div class="container">
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
                        @if($award->image_url)
                            <img src="{{ $award->image_url }}" alt="{{ $award->title }}">
                        @else
                            <img src="https://via.placeholder.com/300x200" alt="No Image Available">
                        @endif

                        <div class="icon-overlay">
                            <i class="fas fa-trophy"></i>
                        </div>

                        <div class="award-details">
                            <h3>{{ $award->title }}</h3>
                            <p>{{ $award->award_year }}</p>
                            <a href="{{ route('frontend.sports_awards.show', $award->id) }}">
                                <i class="fas fa-info-circle"></i> View Details
                            </a>
                        </div>

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
    </div>
</div>
@endsection
