@extends('layouts.layout')

@section('title', 'Teacher Accolade Details')

@section('styles')
<style>
    .accolade-details {
        background-color: #f8f9fa;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-bottom: 30px;
        text-align: center;
    }

    .accolade-details img {
        width: 100%;
        max-width: 500px;
        border-radius: 15px;
        margin-bottom: 20px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    .accolade-details img:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .accolade-details h3 {
        color: #007bff;
        margin-bottom: 20px;
    }

    .accolade-details p {
        color: #555;
        margin-bottom: 20px;
        font-weight: 500;
    }

    .back-btn {
        background-color: #28a745;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease-in-out;
    }

    .back-btn:hover {
        background-color: #218838;
    }

    .lightbox {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        display: none;
    }

    .lightbox img {
        max-width: 90%;
        max-height: 90%;
        border-radius: 15px;
    }

    .lightbox.close {
        display: none;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="accolade-details">
        @if($teacherAccolade->image_url)
            <img src="{{ $teacherAccolade->image_url }}" alt="{{ $teacherAccolade->title }}" onclick="openLightbox('{{ $teacherAccolade->image_url }}')">
        @else
            <img src="https://via.placeholder.com/500x300" alt="No Image Available">
        @endif

        <h3>{{ $teacherAccolade->teacher_name }}</h3>
        <p><strong>Title:</strong> {{ $teacherAccolade->title }}</p>
        <p><strong>Year:</strong> {{ $teacherAccolade->year }}</p>
        <p>{{ $teacherAccolade->description }}</p>

        <a href="{{ route('frontend.teachers_accolades.index') }}" class="back-btn">Back to Accolades</a>
    </div>
</div>

<!-- Lightbox -->
<div class="lightbox" id="lightbox" onclick="closeLightbox()">
    <img src="" alt="Accolade Image" id="lightbox-img">
</div>
@endsection

@section('scripts')
<script>
function openLightbox(imageUrl) {
    document.getElementById('lightbox-img').src = imageUrl;
    document.getElementById('lightbox').style.display = 'flex';
}

function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
}
</script>
@endsection
