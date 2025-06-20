@extends('layouts.layout')

@section('title', 'Class Timetable')
@section('hero_title', 'Class Timetable')
@section('styles')
<style>
    .filter-card {
        background-color: #f8f9fa;
        border-left: 5px solid #0d6efd;
        border-radius: 0.5rem;
        padding: 1.5rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .filter-select {
        padding-left: 2.5rem;
        background-repeat: no-repeat;
        background-position: 0.75rem center;
        background-size: 1rem;
    }

    .select-class {
        background-image: url('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/icons/building.svg');
    }

    .select-section {
        background-image: url('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/icons/diagram-3.svg');
    }
</style>
@endsection

@section('content')
<div class="container py-5">

    <div class="filter-card mb-4">
    <form method="GET" action="{{ route('admin.timetable.view') }}" class="row g-3 align-items-end">
        <div class="col-md-4">
            <!-- <label for="classname" class="form-label fw-semibold">Class</label> -->
            <select name="classname" id="classname" class=" filter-select ">
                <option value="">Select Class</option>
                @foreach($allClasses as $class)
                    <option value="{{ $class }}" {{ request('classname') == $class ? 'selected' : '' }}>
                        {{ $class }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <!-- <label for="section" class="form-label fw-semibold">Section</label> -->
            <select name="section" id="section" class=" filter-select ">
                <option value="">Select Section</option>
                @foreach($allSections as $section)
                    <option value="{{ $section }}" {{ request('section') == $section ? 'selected' : '' }}>
                        {{ $section }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-50">
                <i class="bi bi-filter me-1"></i> Filter
            </button>
            <a href="{{ route('admin.timetable.view') }}" class="btn btn-outline-secondary w-50">
                <i class="bi bi-x-circle me-1"></i> Reset
            </a>
        </div>
    </form>
</div>
    @if($groupedTimetables->isEmpty())
        <div class="text-center text-muted fs-5">
            <i class="bi bi-calendar-x me-2"></i> No timetable available.
        </div>
    @else
        @foreach($groupedTimetables as $group => $days)
            <div class="card shadow-sm mb-4 border-0">
               <div class="card-header text-black d-flex justify-content-between align-items-center"
     style="cursor: pointer; background-color: rgba(136, 138, 141, 0.1); color: #3f4349;"
     onclick="toggleDetails('{{ str_replace(' ', '_', $group) }}')">
    <span>
        <i class="bi bi-building me-2"></i> {{ $group }}
    </span>
    <i class="bi bi-chevron-down toggle-icon" id="toggle-icon-{{ str_replace(' ', '_', $group) }}"></i>
</div>


                <div class="card-body timetable-details" id="{{ str_replace(' ', '_', $group) }}" style="display: none;">
                    @foreach($days as $day => $entries)
                        <h5 class="text-secondary mt-3">
                            <i class="bi bi-calendar-event me-2"></i>{{ $day }}
                        </h5>
                        <div class="table-responsive mb-3">
                            <table class="table table-bordered text-center align-middle">
                                <thead class="table-light">
                                    <tr>
                                        @foreach($entries as $entry)
                                            <th scope="col">
                                                <div class="fw-semibold"> {{ $entry->period_number }}</div>
                                                <div class="text-muted small">
                                                    {{ \Carbon\Carbon::parse($entry->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($entry->end_time)->format('g:i A') }}
                                                </div>
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach($entries as $entry)
                                            <td>
                                                <div class="fw-semibold">{{ $entry->subject }}</div>
                                                <div class="text-muted small">({{ $entry->teacher_name }})</div>
                                            </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @endif

</div>
@endsection

@section('scripts')
<!-- Bootstrap Icons if not already in your layout -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<script>
    function toggleDetails(groupId) {
        const details = document.getElementById(groupId);
        const icon = document.getElementById("toggle-icon-" + groupId);

        if (details.style.display === "none" || details.style.display === "") {
            details.style.display = "block";
            icon.classList.remove("bi-chevron-down");
            icon.classList.add("bi-chevron-up");
        } else {
            details.style.display = "none";
            icon.classList.remove("bi-chevron-up");
            icon.classList.add("bi-chevron-down");
        }
    }
</script>
@endsection
