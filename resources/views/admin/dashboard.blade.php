@extends('layouts.admin')
@section('title', 'Admin Events')

@section('styles')
<style>
    .animated-icon {
        transform: scale(1);
        transition: transform 0.3s ease-in-out;
    }

    .animate-pop {
        animation: pop-rotate 1.2s ease-out forwards;
    }

    @keyframes pop-rotate {
        0% {
            transform: rotate(0deg) scale(0.5);
            opacity: 0;
        }
        50% {
            transform: rotate(180deg) scale(1.2);
            opacity: 1;
        }
        100% {
            transform: rotate(360deg) scale(1);
        }
    }
</style>

@endsection


@section('content')
<div class="container py-5">
    <h2 class="text-center mb-5 fw-bold text-primary">Admin Dashboard</h2>
    <div class="row g-4 justify-content-center homepage-buttons">

        @php
           $buttons = [
    ['route' => 'admin.home', 'label' => 'Home', 'icon' => 'fas fa-home', 'color' => 'primary'],
    ['route' => 'admin.about', 'label' => 'About', 'icon' => 'fas fa-info-circle', 'color' => 'success'],
    ['route' => 'admin.academics', 'label' => 'Academics', 'icon' => 'fas fa-graduation-cap', 'color' => 'warning'],
    ['route' => 'admin.faculties', 'label' => 'Faculty', 'icon' => 'fas fa-chalkboard-teacher', 'color' => 'info'],
    ['route' => 'admin.activities', 'label' => 'Activities', 'icon' => 'fas fa-running', 'color' => 'info'],
    ['route' => 'admin.achievements', 'label' => 'Achievements', 'icon' => 'fas fa-trophy', 'color' => 'info'],
    ['route' => 'admin.galleries', 'label' => 'Gallery', 'icon' => 'fas fa-image', 'color' => 'info'],
    ['route' => 'admin.studentlife', 'label' => 'Student life', 'icon' => 'fas fa-users', 'color' => 'info'],
    ['route' => 'admin.event', 'label' => 'Events', 'icon' => 'fas fa-calendar-day', 'color' => 'info'],
    ['route' => 'admin.onlineapplications', 'label' => 'Online Applications', 'icon' => 'fas fa-file-alt', 'color' => 'info'],
    ['route' => 'admin.kinderHome', 'label' => 'Kinder Home', 'icon' => 'fas fa-home', 'color' => 'success'],
    ['route' => 'admin.certificates.index', 'label' => 'Upload Certificates', 'icon' => 'fas fa-certificate', 'color' => 'success'],
];
        @endphp

        @foreach($buttons as $btn)
        <div class="col-md-3 col-sm-6" data-aos="zoom-in">
            <div class="card h-100 text-center shadow-sm border-0 bg-light">
                <div class="card-body d-flex flex-column align-items-center justify-content-center py-4">
                   <i class="{{ $btn['icon'] }} fa-3x text-{{ $btn['color'] }} mb-3 animated-icon"></i>
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

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const icons = document.querySelectorAll('.animated-icon');
        icons.forEach((icon, index) => {
            setTimeout(() => {
                icon.classList.add('animate-pop');
            }, index * 300); // delay each animation
        });
    });
</script>
@endsection

