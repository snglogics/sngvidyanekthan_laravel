@extends('layouts.admin')

@section('title', 'Campus Overviews')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Campus Overviews</h2>
    <a href="{{ route('admin.campus-overviews.create') }}" class="btn btn-primary mb-4">Add New Overview</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row">
        @foreach($overviews as $overview)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h4>{{ $overview->main_heading }}</h4>
                        <p>{{ Str::limit($overview->description, 150) }}</p>
                        <a href="{{ route('admin.campus-overviews.show', $overview->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.campus-overviews.edit', $overview->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.campus-overviews.destroy', $overview->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection






