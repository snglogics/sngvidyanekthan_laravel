@extends('layouts.layout')
@section('content')

<!-- -- Principal's Message Card -- -->
<div class="card p-4 my-4 shadow-lg border-0" style="max-width: 1100px; margin: auto;">
    <div class="row g-4 align-items-center">
        
        <!-- Left: Image + Name -->
        <div class="col-md-4 text-center">
            <img src="{{ asset($principalMsg->image_url) }}" alt="Principal" class="img-fluid rounded-3 shadow" style="max-height: 300px; object-fit: cover;">
            <p class="mt-3 fw-bold text-primary fs-5">{{ $principalMsg->image_name }}</p>
        </div>
 
        <!-- Right: Message -->
        <div class="col-md-8">
            <h2 class="text-dark fw-semibold mb-3">{{ $principalMsg->image_header }}</h2>
            <p id="principal-message" class="text-muted" style="max-height: 150px; overflow: hidden;">
                {{ $principalMsg->image_description }}
            </p>
            <button id="toggle-button" class="btn btn-outline-primary mt-2" onclick="toggleMessage()">Read more</button>
        </div>

        <!-- Manager Message -->
        <div class="row g-4 align-items-center">
        
        <!-- Left: Image + Name -->
        <div class="col-md-4 text-center">
            <img src="{{ asset($managerMsg->image_url) }}" alt="Principal" class="img-fluid rounded-3 shadow" style="max-height: 300px; object-fit: cover;">
            <p class="mt-3 fw-bold text-primary fs-5">{{ $managerMsg->image_name }}</p>
        </div>

        <!-- Right: Message -->
        <div class="col-md-8">
            <h2 class="text-dark fw-semibold mb-3">{{ $managerMsg->image_header }}</h2>
            <p id="manager-message" class="text-muted" style="max-height: 150px; overflow: hidden;">
                {{ $managerMsg->description }}
            </p>
            <button id="mntoggle-button" class="btn btn-outline-primary mt-2" onclick="mngrtoggleMessage()">Read more</button>
        </div>

    </div>
</div>


<script>
    const principalMessageText = @json($principalMsg->description);
    const managerMessageText = @json($managerMsg->description);
</script>

<script src="{{ asset('frontend/js/principal-message.js') }}"></script>


<!-- End of Principal Message -->
 @endsection