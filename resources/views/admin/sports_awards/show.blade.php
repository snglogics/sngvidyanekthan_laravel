@extends('layouts.admin')

@section('title', 'Sports Award Details')

@section('content')
<div class="container mt-4">
    <h2>{{ $sportsAward->title }}</h2>

    @if($sportsAward->image_url)
        <img src="{{ $sportsAward->image_url }}" alt="{{ $sportsAward->title }}" width="300" class="mb-3">
    @endif

    <p><strong>Award Year:</strong> {{ $sportsAward->award_year }}</p>
    <p><strong>Description:</strong> {{ $sportsAward->description }}</p>

    <a href="{{ route('admin.sports_awards.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
