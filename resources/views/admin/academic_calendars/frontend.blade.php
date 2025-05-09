@extends('layouts.layout')

@section('title', 'Academic Events')

@section('content')
<div class="container py-5">
    <h2 class="text-center text-primary mb-4">Academic Events</h2>

    <!-- Filters -->
    <div class="row mb-4">
        <div class="col-md-6">
            <label>Filter by Academic Year</label>
            <select id="academicYearFilter" class="form-control">
                <option value="all">All</option>
                @foreach($academicYears as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label>Filter by Month</label>
            <select id="monthFilter" class="form-control">
                <option value="all">All</option>
                @foreach(range(1, 12) as $month)
                    <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Events List -->
    <div id="eventsContainer" class="row"></div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function loadEvents() {
            const year = document.getElementById('academicYearFilter').value;
            const month = document.getElementById('monthFilter').value;
            
            fetch(`/academic-calendars/events?academic_year=${year}&month=${month}`)
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('eventsContainer');
                    container.innerHTML = '';

                    if (data.length === 0) {
                        container.innerHTML = '<p class="text-center text-muted">No events found for this filter.</p>';
                        return;
                    }

                    data.forEach(event => {
                        const card = document.createElement('div');
                        card.classList.add('col-md-4', 'mb-4');

                        card.innerHTML = `
                            <div class="card text-white shadow-lg" style="background-image: url('${event.attachment_url || 'https://via.placeholder.com/400x200'}'); background-size: cover; background-position: center;">
                                <div class="card-body" style="background-color: rgba(0, 0, 0, 0.6);">
                                    <h5 class="card-title">${event.event_name}</h5>
                                    <p class="card-text">
                                        <strong>Date:</strong> ${event.start_date} - ${event.end_date || 'N/A'}<br>
                                        <strong>Audience:</strong> ${event.audience || 'N/A'}
                                    </p>
                                    <a href="${event.attachment_url || '#'}" target="_blank" class="btn btn-light btn-sm">View Attachment</a>
                                </div>
                            </div>
                        `;

                        container.appendChild(card);
                    });
                })
                .catch(error => console.error('Error fetching events:', error));
        }

        // Initial Load
        loadEvents();

        // Reload on filter change
        document.getElementById('academicYearFilter').addEventListener('change', loadEvents);
        document.getElementById('monthFilter').addEventListener('change', loadEvents);
    });
</script>
@endsection
