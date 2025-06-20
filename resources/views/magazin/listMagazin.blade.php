@extends('layouts.layout')
@section('title', 'Magazines')
@section('hero_title', 'Magazines')

@section('styles')
<style>
    .book-card {
        position: relative;
        background: linear-gradient(135deg, #fff, #f7f7f7);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        height: 280px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.3s ease;
    }

    .book-card:hover {
        transform: translateY(-5px);
    }

    .book-label {
        position: absolute;
        top: 0;
        left: 0;
        background-color: #343a40;
        color: #fff;
        padding: 0.25rem 0.6rem;
        font-size: 0.75rem;
        font-weight: bold;
        border-bottom-right-radius: 12px;
        text-transform: uppercase;
        z-index: 2;
    }

    .book-title {
        font-size: 1.1rem;
        font-weight: 600;
        padding: 1rem 1rem 0.5rem;
        color: #333;
        flex: 1;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .book-footer {
        padding: 0 1rem 1rem;
    }

    .download-button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 0.4rem 1rem;
    border-radius: 6px;
    font-size: 0.9rem;
    text-decoration: none;
    transition: background-color 0.2s ease;
    display: inline-block;
}

.download-button:hover {
    background-color: #0056b3;
}

.read-button {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 0.4rem 1rem;
    border-radius: 6px;
    font-size: 0.9rem;
    text-decoration: none;
    transition: background-color 0.2s ease;
    display: inline-block;
}


    .read-button:hover {
        background-color: #218838;
    }

    @media (max-width: 576px) {
        .book-card {
            height: auto;
        }
    }
</style>
@endsection

@section('content')
<div class="container my-4">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        @foreach($magazines as $magazine)
           <div class="col d-flex">
    <div class="book-card w-100">
        <div class="book-label">Magazine</div>
        <div class="book-title">
            {{ $magazine->title }}
        </div>
        <div class="book-footer d-flex justify-content-between align-items-center">
            <a href="{{ route('magazines.show', $magazine->id) }}" class="read-button text-decoration-none">Read Now</a>
            <a href="{{ route('magazines.download', $magazine->id) }}" class="download-button text-decoration-none">Download</a>
        </div>
    </div>
</div>
        @endforeach
    </div>
</div>
@endsection
