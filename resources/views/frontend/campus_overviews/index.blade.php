@extends('layouts.layout')

@section('title', 'Campus Overviews')

@section('styles')
<style>
    .campus-section {
        background: #f8f9fa;
        padding: 60px 0;
    }

    .campus-card-horizontal {
        display: flex;
        flex-direction: row;
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .campus-card-horizontal:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }

    .campus-card-horizontal img {
        width: 100%;
        max-width: 300px;
        height: 100%;
        object-fit: cover;
    }

    .campus-card-body {
        padding: 1.5rem;
        flex: 1;
    }

    .campus-card-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #333;
    }

    .campus-card-desc {
        font-size: 1rem;
        color: #555;
    }

    .campus-heading {
        font-size: 1.75rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #333;
    }

    .icon {
        font-size: 1.5rem;
        color: #007bff;
        margin-right: 10px;
    }

    @media (max-width: 768px) {
        .campus-card-horizontal {
            flex-direction: column;
        }

        .campus-card-horizontal img {
            max-width: 100%;
        }
    }

    /* parallel effect */
    .campus-card-horizontal {
    position: relative;
    display: flex;
    flex-direction: row;
    align-items: center;
    border-radius: 12px;
    overflow: hidden;
    background-size: cover;
    background-position: center;
    height: 300px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
    transition: transform 0.4s ease, box-shadow 0.4s ease;
}

.campus-card-horizontal:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
}

.campus-overlay {
    background: rgba(0, 0, 0, 0.5); /* dark transparent overlay */
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
}

.campus-card-body {
    color: white;
    padding: 2rem;
    max-width: 600px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(6px);
    border-radius: 10px;
    margin-left: 2rem;
    animation: fadeIn 0.8s ease-in-out;
}

.flex-row-reverse .campus-card-body {
    margin-left: 0;
    margin-right: 2rem;
}

.campus-card-title {
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
    color: #fff;
}

.campus-card-desc {
    font-size: 1.1rem;
    line-height: 1.6;
    color: #f1f1f1;
}

@media (max-width: 768px) {
    .campus-card-horizontal {
        flex-direction: column;
        height: auto;
    }

    .campus-card-body {
        margin: 1rem;
        text-align: center;
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection

@section('hero_title', 'Campus Overview')

@section('content')
<div class="campus-section container">
    @if($overviews->count())
        @foreach($overviews as $campusOverview)
            @php
                // Alternate image position based on overview index
                $reverse = $loop->iteration % 2 === 0;

                // Get first photo only
                $photo = !empty($campusOverview->photos) && is_array($campusOverview->photos)
                    ? $campusOverview->photos[0]
                    : null;
            @endphp

            <div class="mb-5">
                <h2 class="campus-heading">
                    <i class="fas fa-map-marker-alt icon"></i>{{ $campusOverview->main_heading }}
                </h2>

                @if($photo)
                   <div class="campus-card-horizontal {{ $reverse ? 'flex-row-reverse' : '' }}" 
     style="background-image: url('{{ $photo['url'] ?? asset('images/placeholder.png') }}')">
    <div class="campus-overlay">
        <div class="campus-card-body">
            <h4 class="campus-card-title">
                <i class="fas fa-image icon"></i>{{ $photo['title'] ?? 'Campus Photo' }}
            </h4>
            <p class="campus-card-desc">{{ $campusOverview->description }}</p>
        </div>
    </div>
</div>
                @else
                    <p class="text-muted">No photos available.</p>
                @endif
            </div>
        @endforeach
    @else
        <p class="text-center text-muted">No campus overviews found.</p>
    @endif
</div>
@endsection
