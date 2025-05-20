@extends('layouts.admin')

@section('title', 'Cultural Competitions')
@section('breadcrumb-title', 'Achievements')
@section('breadcrumb-link', route('admin.achievements'))

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endsection

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4 d-flex justify-content-between align-items-center">
            <div>
                <i class="bi bi-stars me-2 fs-4"></i>
                <h4 class="mb-0 d-inline">Cultural Competitions</h4>
            </div>
            <a href="{{ route('admin.cultural_competitions.create') }}" class="btn btn-light btn-sm rounded-3 shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Add New
            </a>
        </div>

        <div class="card-body p-4">
            {{-- Flash Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                    <i class="bi bi-check-circle-fill me-1"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col"><i class="bi bi-hash"></i> ID</th>
                            <th scope="col"><i class="bi bi-bookmark-star-fill text-primary"></i> Title</th>
                            <th scope="col"><i class="bi bi-calendar-event text-success"></i> Year</th>
                            <th scope="col"><i class="bi bi-image-fill text-danger"></i> Image</th>
                            <th scope="col"><i class="bi bi-gear-fill"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($competitions as $competition)
                            <tr>
                                <td>{{ $competition->id }}</td>
                                <td>{{ $competition->title }}</td>
                                <td>{{ $competition->competition_year }}</td>
                                <td>
                                    <img src="{{ $competition->image_url ?: 'https://via.placeholder.com/100' }}"
                                         alt="{{ $competition->title }}"
                                         class="img-thumbnail rounded" width="100">
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Actions">
                                        <a href="{{ route('admin.cultural_competitions.show', $competition->id) }}"
                                           class="btn btn-info btn-sm rounded-start">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="{{ route('admin.cultural_competitions.edit', $competition->id) }}"
                                           class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admin.cultural_competitions.destroy', $competition->id) }}"
                                              method="POST" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm rounded-end">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No competitions found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
