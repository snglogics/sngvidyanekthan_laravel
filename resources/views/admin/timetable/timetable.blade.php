@extends('layouts.layout')

@section('title', 'Class Timetable')



@section('content')
<div class="container py-5">
    <h2 class="text-center text-primary fw-bold mb-4">Class Timetable</h2>

    @foreach($groupedTimetables as $group => $days)
        @foreach($days as $day => $entries)
            <div class="timetable-card">
                <div class="timetable-header">{{ $group }} - {{ $day }}</div>

                <table class="timetable-table">
                    <thead>
                        <tr>
                            @foreach($entries as $entry)
                                <th>
                                    {{ $entry->period_number }}<br>
                                    ({{ \Carbon\Carbon::parse($entry->start_time)->format('g:i') }} - {{ \Carbon\Carbon::parse($entry->end_time)->format('g:i') }})
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
            </div>
        @endforeach
    @endforeach
</div>
@endsection
