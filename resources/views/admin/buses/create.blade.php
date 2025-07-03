@extends('layouts.admin')

@section('title', isset($bus) ? 'Edit Bus Route' : 'Add Bus Route')

@section('content')
    <div class="container py-4">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-bus-alt"></i>
                    {{ isset($bus) ? 'Edit Bus Route' : 'Add New Bus Route' }}
                </h5>
            </div>

            <div class="card-body">
                <form method="POST"
                    action="{{ isset($bus) ? route('admin.buses.update', $bus) : route('admin.buses.store') }}">
                    @csrf
                    @if (isset($bus))
                        @method('PUT')
                    @endif

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label"><i class="fas fa-hashtag"></i> Bus No</label>
                            <input type="text" name="bus_no" class="form-control" placeholder="Bus No"
                                value="{{ old('bus_no', $bus->bus_no ?? '') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><i class="fas fa-user"></i> Driver Name</label>
                            <input type="text" name="driver_name" class="form-control" placeholder="Driver Name"
                                value="{{ old('driver_name', $bus->driver_name ?? '') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><i class="fas fa-phone"></i> Driver Phone</label>
                            <input type="text" name="driver_phone" class="form-control" placeholder="Driver Phone"
                                value="{{ old('driver_phone', $bus->driver_phone ?? '') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><i class="fas fa-user-tie"></i> Attender Name</label>
                            <input type="text" name="attender_name" class="form-control" placeholder="Attender Name"
                                value="{{ old('attender_name', $bus->attender_name ?? '') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><i class="fas fa-phone"></i> Attender Phone</label>
                            <input type="text" name="attender_phone" class="form-control" placeholder="Attender Phone"
                                value="{{ old('attender_phone', $bus->attender_phone ?? '') }}" required>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h5><i class="fas fa-map-marker-alt text-danger"></i> Bus Stops</h5>
                    <div id="stops-container" class="row g-3">
                        @if (isset($bus))
                            @foreach ($bus->stops as $stop)
                                <div class="col-md-4 stop-row">
                                    <div class="card p-2">
                                        <input type="text" name="stops[{{ $loop->index }}][stop_name]"
                                            class="form-control mb-2" value="{{ $stop->stop_name }}" placeholder="Stop Name"
                                            required>
                                        <input type="time" name="stops[{{ $loop->index }}][morning_time]"
                                            class="form-control mb-2" value="{{ $stop->morning_time }}" required>
                                        <input type="time" name="stops[{{ $loop->index }}][evening_time]"
                                            class="form-control" value="{{ $stop->evening_time }}" required>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-4 stop-row">
                                <div class="card p-2">
                                    <input type="text" name="stops[0][stop_name]" class="form-control mb-2"
                                        placeholder="Stop Name" required>
                                    <input type="time" name="stops[0][morning_time]" class="form-control mb-2" required>
                                    <input type="time" name="stops[0][evening_time]" class="form-control" required>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="my-3">
                        <button type="button" class="btn btn-outline-primary" onclick="addStopRow()">
                            <i class="fas fa-plus-circle"></i> Add Stop
                        </button>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> {{ isset($bus) ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let stopIndex = {{ isset($bus) ? $bus->stops->count() : 1 }};

        function addStopRow() {
            const container = document.getElementById('stops-container');
            const col = document.createElement('div');
            col.classList.add('col-md-4', 'stop-row');

            col.innerHTML = `
            <div class="card p-2">
                <input type="text" name="stops[${stopIndex}][stop_name]" class="form-control mb-2" placeholder="Stop Name" required>
                <input type="time" name="stops[${stopIndex}][morning_time]" class="form-control mb-2" required>
                <input type="time" name="stops[${stopIndex}][evening_time]" class="form-control" required>
            </div>
        `;

            container.appendChild(col);
            stopIndex++;
        }
    </script>
@endsection
