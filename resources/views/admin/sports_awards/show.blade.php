@extends('layouts.admin')

@section('title', 'Sports Award Details')
@section('breadcrumb-title', 'Achievements')
@section('breadcrumb-link', route('admin.achievements'))

@section('styles')
<style>
    .award-card {
        background-color: #fff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: 0 auto 40px;
    }

    .award-title {
        color: #28a745;
        font-weight: bold;
        font-size: 28px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .award-image {
        border-radius: 10px;
        border: 1px solid #ccc;
        margin-bottom: 20px;
    }

    .btn-secondary {
        border-radius: 8px;
    }

    .award-meta {
        font-size: 16px;
        margin-bottom: 15px;
    }

    .award-meta strong {
        color: #555;
    }

    .fa-trophy {
        color: #f39c12;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
@endsection

@section('content')
<div class="container mt-4">
    <div class="award-card">
        <div class="award-title">
            <i class="fas fa-trophy"></i> {{ $sportsAward->title }}
        </div>

        @if($sportsAward->image_url)
            <img src="{{ $sportsAward->image_url }}" alt="{{ $sportsAward->title }}" width="300" class="award-image">
        @endif

        <p class="award-meta"><strong><i class="fas fa-calendar-alt me-1"></i>Award Year:</strong> {{ $sportsAward->award_year }}</p>
        <p class="award-meta"><strong><i class="fas fa-align-left me-1"></i>Description:</strong> {{ $sportsAward->description }}</p>

        <a href="{{ route('admin.sports_awards.index') }}" class="btn btn-secondary mt-3">
            <i class="fas fa-arrow-left me-1"></i>Back to List
        </a>
    </div>
</div>
@endsection
