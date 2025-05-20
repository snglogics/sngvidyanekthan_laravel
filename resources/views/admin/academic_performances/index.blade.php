@extends('layouts.admin')

@section('breadcrumb-title', 'Achievements')
@section('breadcrumb-link', route('admin.achievements'))

{{-- Include Bootstrap Icons --}}
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endsection

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">🎓 Academic Performances</h2>
        <a href="{{ route('admin.academic_performances.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Add New
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">👨‍🎓 Student</th>
                        <th scope="col">🎟️ Roll</th>
                        <th scope="col">🏫 Class</th>
                        <th scope="col">📅 Year</th>
                        <th scope="col" class="text-center">⚙️ Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($performances as $performance)
                    <tr>
                        <td>{{ $performance->id }}</td>
                        <td>{{ $performance->student_name }}</td>
                        <td>{{ $performance->roll_number }}</td>
                        <td>{{ $performance->class }}</td>
                        <td>{{ $performance->year }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.academic_performances.edit', $performance->id) }}" class="btn btn-sm btn-warning me-1">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.academic_performances.destroy', $performance->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <i class="bi bi-emoji-frown" style="font-size: 1.5rem;"></i><br>
                            No academic performances found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
