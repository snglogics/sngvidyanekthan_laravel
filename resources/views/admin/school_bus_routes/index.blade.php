@extends('layouts.admin')

@section('title', 'School Bus Routes')
@section('breadcrumb-title', 'School Bus Routes')
@section('breadcrumb-link', route('admin.school_bus_routes.index'))

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
@endsection

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0"><i class="fas fa-bus-alt me-2"></i>School Bus Routes</h2>
        <a href="{{ route('admin.school_bus_routes.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-1"></i> Add New Route
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            @if($routes->isEmpty())
                <div class="p-4 text-center text-muted">
                    <i class="fas fa-info-circle fa-2x mb-2"></i>
                    <p>No bus routes available. Click "Add New Route" to get started.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Route Name</th>
                                <th>Bus Number</th>
                                <th>Driver Name</th>
                                <th>Driver Contact</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($routes as $route)
                            <tr>
                                <td>{{ $route->id }}</td>
                                <td>{{ $route->route_name }}</td>
                                <td>{{ $route->bus_number }}</td>
                                <td>{{ $route->driver_name }}</td>
                                <td>{{ $route->driver_contact }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.school_bus_routes.show', $route->id) }}" class="btn btn-sm btn-info me-1">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.school_bus_routes.edit', $route->id) }}" class="btn btn-sm btn-warning me-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.school_bus_routes.destroy', $route->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this route?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    @if(method_exists($routes, 'links'))
        <div class="mt-3">
            {{ $routes->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
