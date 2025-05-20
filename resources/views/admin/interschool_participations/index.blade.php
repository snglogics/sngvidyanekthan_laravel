@extends('layouts.admin')

@section('title', 'Interschool Participations')
@section('breadcrumb-title', 'Activities')
@section('breadcrumb-link', route('admin.activities'))

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endsection

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2><i class="bi bi-people-fill me-2 text-primary"></i> Interschool Participations</h2>
        <a href="{{ route('admin.interschool-participations.create') }}" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Add Participation
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm rounded">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th><i class="bi bi-person-fill"></i> Student</th>
                            <th><i class="bi bi-award-fill"></i> Event</th>
                            <th><i class="bi bi-calendar-event-fill"></i> Date</th>
                            <th><i class="bi bi-trophy-fill"></i> Position</th>
                            <th><i class="bi bi-building-fill"></i> School</th>
                            <th><i class="bi bi-image-fill"></i> Photo</th>
                            <th class="text-center"><i class="bi bi-gear-fill"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($participations as $participation)
                        <tr>
                            <td>{{ $participation->student_name }}</td>
                            <td>{{ $participation->event_name }}</td>
                            <td>{{ $participation->event_date->format('Y-m-d') }}</td>
                            <td>
                                @if($participation->position)
                                    <span class="badge bg-info text-dark">{{ $participation->position }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $participation->school_name }}</td>
                            <td>
                                @if($participation->photo_url)
                                    <img src="{{ $participation->photo_url }}" alt="Photo" class="img-thumbnail" style="height: 60px;">
                                @else
                                    <span class="text-muted">No photo</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.interschool-participations.edit', $participation) }}" class="btn btn-sm btn-warning me-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.interschool-participations.destroy', $participation) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this participation?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="bi bi-emoji-frown" style="font-size: 1.5rem;"></i><br>
                                No participations found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $participations->links() }}
    </div>
</div>
@endsection
