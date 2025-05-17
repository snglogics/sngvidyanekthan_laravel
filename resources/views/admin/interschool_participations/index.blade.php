@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2>Interschool Participations</h2>
    <a href="{{ route('admin.interschool-participations.create') }}" class="btn btn-primary mb-3">Add New Participation</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student</th>
                <th>Event</th>
                <th>Date</th>
                <th>Position</th>
                <th>School</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($participations as $participation)
            <tr>
                <td>{{ $participation->student_name }}</td>
                <td>{{ $participation->event_name }}</td>
                <td>{{ $participation->event_date->format('Y-m-d') }}</td>
                <td>{{ $participation->position ?? '-' }}</td>
                <td>{{ $participation->school_name }}</td>
                <td>
                    @if($participation->photo_url)
                        <img src="{{ $participation->photo_url }}" alt="Photo" style="height: 60px;">
                    @else
                        -
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.interschool-participations.edit', $participation) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.interschool-participations.destroy', $participation) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this record?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No participations found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $participations->links() }}
</div>
@endsection
