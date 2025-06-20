@extends('layouts.admin')
@section('title', 'Admin Events')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-5 fw-bold text-primary">Kinder Garden</h2>
    <div class="row g-4 justify-content-center homepage-buttons">

        @php
            $buttons = [
                ['route' => 'admin.kinder-sliders.index', 'label' => 'Manage Sliders', 'icon' => 'fas fa-images', 'color' => 'primary'],
                ['route' => 'admin.kinderprincipal.form', 'label' => 'Edit Principal’s Message', 'icon' => 'fas fa-user-tie', 'color' => 'success'],
                ['route' => 'admin.kinder.list', 'label' => 'Manage Gallery', 'icon' => 'fas fa-photo-video', 'color' => 'warning'],
               
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