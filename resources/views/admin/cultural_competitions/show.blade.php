@extends('layouts.admin')

@section('title', 'Cultural Competition Details')

@section('content')
<div class="container mt-4">
    <h2>{{ $culturalCompetition->title }}</h2>

    @if($culturalCompetition->image_url)
        <img src="{{ $culturalCompetition->image_url }}" alt="{{ $culturalCompetition->title }}" width="300" class="mb-3">
    @endif

    <p><strong>Year:</strong> {{ $culturalCompetition->competition_year }}</p>
    <p><strong>Description:</strong> {{ $culturalCompetition->description }}</p>

    <a href="{{ route('admin.cultural_competitions.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
