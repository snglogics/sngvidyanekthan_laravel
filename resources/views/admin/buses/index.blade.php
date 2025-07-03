@extends('layouts.admin')

@section('title', 'Bus Routes')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3"><i class="fas fa-bus-alt text-primary"></i> Bus Routes</h1>
            <a href="{{ route('admin.buses.create') }}" class="btn btn-success">
                <i class="fas fa-plus-circle"></i> Add New Bus Route
            </a>
        </div>

        @if ($buses->isEmpty())
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i> No bus routes found.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col"><i class="fas fa-hashtag"></i> Bus No</th>
                            <th scope="col"><i class="fas fa-user"></i> Driver</th>
                            <th scope="col"><i class="fas fa-user-tie"></i> Attender</th>
                            <th scope="col"><i class="fas fa-map-marked-alt"></i> Stops</th>
                            <th scope="col"><i class="fas fa-cogs"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buses as $bus)
                            <tr>
                                <td class="fw-bold text-primary">{{ $bus->bus_no }}</td>
                                <td>
                                    <i class="fas fa-user text-success"></i> {{ $bus->driver_name }}<br>
                                    <i class="fas fa-phone text-muted"></i> {{ $bus->driver_phone }}
                                </td>
                                <td>
                                    <i class="fas fa-user-tie text-warning"></i> {{ $bus->attender_name }}<br>
                                    <i class="fas fa-phone text-muted"></i> {{ $bus->attender_phone }}
                                </td>
                                <td>
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($bus->stops as $stop)
                                            <li class="mb-1">
                                                <i class="fas fa-map-marker-alt text-danger"></i>
                                                <strong>{{ $stop->stop_name }}</strong><br>
                                                <span class="badge bg-success"><i class="fas fa-sun"></i>
                                                    {{ $stop->morning_time }}</span>
                                                <span class="badge bg-primary"><i class="fas fa-moon"></i>
                                                    {{ $stop->evening_time }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <a href="{{ route('admin.buses.edit', $bus) }}" class="btn btn-sm btn-warning mb-1">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.buses.destroy', $bus) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger mb-1"
                                            onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash-alt"></i> Delete
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
@endsection
