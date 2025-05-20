@extends('layouts.admin')

@section('title', 'Sports Awards')
@section('breadcrumb-title', 'Achievements')
@section('breadcrumb-link', route('admin.achievements'))

@section('styles')
<style>
    .table-container {
        background: #fff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        max-width: 1000px;
        margin: 0 auto 40px;
    }

    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .table-header h2 {
        font-weight: bold;
        color: #28a745;
    }

    .btn-primary {
        background-color: #28a745;
        border-color: #28a745;
        border-radius: 8px;
    }

    .btn-primary:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .table th {
        background-color: #f8f9fa;
        color: #333;
        font-weight: bold;
    }

    .table td,
    .table th {
        vertical-align: middle;
    }

    .table img {
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    .btn-sm i {
        margin-right: 5px;
    }

    .alert {
        max-width: 1000px;
        margin: 0 auto 20px;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
@endsection

@section('content')
<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    <div class="table-container">
        <div class="table-header">
            <h2><i class="fas fa-award me-2"></i>Sports Awards</h2>
            <a href="{{ route('admin.sports_awards.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-1"></i>Add New Award
            </a>
        </div>

        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Award Year</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($awards as $award)
                <tr>
                    <td>{{ $award->id }}</td>
                    <td>{{ $award->title }}</td>
                    <td>{{ $award->award_year }}</td>
                    <td>
                        @if($award->image_url)
                            <img src="{{ $award->image_url }}" alt="{{ $award->title }}" width="100">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.sports_awards.show', $award->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('admin.sports_awards.edit', $award->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.sports_awards.destroy', $award->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this award?')">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No awards found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
