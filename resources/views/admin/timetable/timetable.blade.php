@extends('layouts.layout')

@section('title', 'Class Timetable')



@section('content')
<div class="container py-5">
    <h2 class="text-center text-primary fw-bold mb-4">Class Timetable</h2>

    @foreach($groupedTimetables as $group => $days)
        <div class="timetable-card" onclick="toggleDetails('{{ str_replace(' ', '_', $group) }}')">
            <div class="timetable-header">
                <i class="fa-solid fa-school"></i> {{ $group }}
                <i class="fa-solid fa-chevron-down toggle-icon" id="toggle-icon-{{ str_replace(' ', '_', $group) }}"></i>
            </div>

            <div class="timetable-details" id="{{ str_replace(' ', '_', $group) }}">
                @foreach($days as $day => $entries)
                    <h4 class="text-secondary">{{ $day }}</h4>
                    <table class="timetable-table">
                        <thead>
                            <tr>
                                @foreach($entries as $entry)
                                    <th>
                                        {{ $entry->period_number }}<br>
                                        ({{ \Carbon\Carbon::parse($entry->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($entry->end_time)->format('g:i A') }})
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($entries as $entry)
                                    <td class="subject-cell">
                                        {{ $entry->subject }}
                                        <small>({{ $entry->teacher_name }})</small>
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
@endsection

@section('scripts')
<script>
    function toggleDetails(groupId) {
        const details = document.getElementById(groupId);
        const icon = document.getElementById("toggle-icon-" + groupId);
        
        if (details.style.display === "none" || details.style.display === "") {
            details.style.display = "block";
            icon.classList.remove("fa-chevron-down");
            icon.classList.add("fa-chevron-up");
        } else {
            details.style.display = "none";
            icon.classList.remove("fa-chevron-up");
            icon.classList.add("fa-chevron-down");
        }
    }
</script>
@endsection
