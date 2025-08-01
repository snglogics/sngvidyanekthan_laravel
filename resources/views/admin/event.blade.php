@extends('layouts.admin')
@section('title', 'Admin Events')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-5 fw-bold text-primary">Events</h2>
    <div class="row g-4 justify-content-center homepage-buttons">

        @php
            $buttons = [
                ['route' => 'admin.events.index', 'label' => 'Upcoming Events', 'icon' => 'fas fa-calendar-check', 'color' => 'primary'],
                ['route' => 'news.create', 'label' => 'News', 'icon' => 'fas fa-newspaper', 'color' => 'success'],
                ['route' => 'events.upload', 'label' => 'Update Events', 'icon' => 'fas fa-upload', 'color' => 'info'],
            ];
        @endphp

        @foreach($buttons as $btn)
        <div class="col-md-3 col-sm-6" data-aos="zoom-in">
            <div class="card h-100 text-center shadow-sm border-0 bg-light">
                <div class="card-body d-flex flex-column align-items-center justify-content-center py-4">
                    <i class="{{ $btn['icon'] }} fa-3x text-{{ $btn['color'] }} mb-3"></i>
                    <h5 class="card-title">{{ $btn['label'] }}</h5>
                    <button onclick="window.location.href='{{ route($btn['route']) }}'" class="btn btn-outline-{{ $btn['color'] }} mt-2 w-100">
                        Go
                    </button>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection