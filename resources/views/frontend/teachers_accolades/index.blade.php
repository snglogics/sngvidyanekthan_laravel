@extends('layouts.layout')

@section('title', 'Teachers Accolades')

@section('styles')
<style>
    .accolades-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 20px;
        padding-bottom: 20px;
    }

    .accolade-card {
        background-color: #ffffff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
        position: relative;
        cursor: pointer;
    }

    .accolade-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 15px 15px 0 0;
    }

    .accolade-card h3 {
        padding: 15px;
        font-size: 20px;
        color: #007bff;
        margin: 0;
        text-align: center;
    }

    .accolade-card p {
        padding: 0 15px 15px;
        color: #555;
        text-align: center;
        font-weight: 500;
    }

    .accolade-card .icon-overlay {
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

    .accolade-card .icon-overlay:hover {
        background-color: #0056b3;
        transform: rotate(360deg);
    }

    .accolade-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }

    .accolade-card a {
        display: block;
        color: #007bff;
        font-weight: 600;
        padding: 10px 15px;
        text-align: center;
        background-color: #f8f9fa;
        border-radius: 0 0 15px 15px;
        text-decoration: none;
        transition: all 0.3s ease-in-out;
    }

    .accolade-card a:hover {
        background-color: #007bff;
        color: #fff;
    }
</style>
@endsection

@section('content')
<div class="container">
    <h2 class="mb-4">Teachers Accolades</h2>

    <div class="accolades-container">
        @foreach($accolades as $accolade)
            <div class="accolade-card">
                @if($accolade->image_url)
                    <img src="{{ $accolade->image_url }}" alt="{{ $accolade->title }}">
                @else
                    <img src="https://via.placeholder.com/300x200" alt="No Image Available">
                @endif
                <div class="icon-overlay">
                    <i class="fas fa-certificate"></i>
                </div>
                <h3>{{ $accolade->teacher_name }}</h3>
                <p>{{ $accolade->title }} ({{ $accolade->year }})</p>
                <a href="{{ route('frontend.teachers_accolades.show', $accolade->id) }}">View Details</a>
            </div>
        @endforeach
    </div>
</div>
@endsection
