@extends('layouts.layout')

@section('title', 'Academic Events')
@section('hero_title')
    <i class="bi bi-calendar-event text-primary me-2"></i> Academic Calendar
@endsection

@section('content')
    <style>
        .parallax-bg {
            background-image: url('/frontend/images/parallel16.jpg');
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            padding: 80px 0;
        }

        .parallax-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 0;
        }

        .month-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.15);
            margin-bottom: 30px;
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: row;
        }

        .month-card:hover {
            transform: translateY(-5px);
        }

        .month-header {
            padding: 15px 20px;
            background: rgba(0, 123, 255, 0.8);
            color: white;
            border-radius: 15px 15px 0 0;
        }

        .month-header h3 {
            margin: 0;
            font-weight: 600;
        }

        .event-list {
            padding: 15px;
            display: flex;
            flex-direction: row;
            gap: 10px;
            flex-wrap: wrap;
            flex-wrap: wrap;
            /* justify-content: space-evenly; */


            /* Adjust height as needed */
        }

        .event-item {
            padding: 15px;
            background: rgba(255, 255, 255, 0.05);
            /* subtle background */
            border: 1px solid rgba(255, 255, 255, 0.15);
            /* visible but soft border */
            border-radius: 10px;
            transition: transform 0.2s ease, background 0.3s ease, border-color 0.3s ease;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 250px;

        }

        .event-item:last-child {
            border-bottom: none;
        }

        .event-item:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .event-date {
            width: 60px;
            height: 60px;
            background: rgba(0, 0, 0, 0.2);
            color: white;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .event-date .day {
            font-size: 20px;
            font-weight: bold;
            line-height: 1;
        }

        .event-date .month {
            font-size: 11px;
            text-transform: uppercase;
            line-height: 1;
        }

        /* Centered Modal */
        .modal-dialog-centered {
            display: flex;
            align-items: center;
            min-height: calc(100% - 1rem);
        }

        .modal-content {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            background: linear-gradient(to right, #007bff, #0056b3);
            color: white;
            border-bottom: none;
            padding: 1.5rem;
        }

        .modal-body {
            padding: 2rem;
        }

        .modal-footer {
            border-top: none;
            padding: 1rem 2rem;
            background: #f8f9fa;
        }

        .btn-close-white {
            filter: invert(1) brightness(100%);
        }

        .no-events {
            padding: 30px;
            text-align: center;
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.1rem;
        }

        .event-details-row {
            margin-bottom: 15px;
        }

        .event-details-label {
            font-weight: 600;
            color: #495057;
        }

        .event-details-value {
            color: #212529;
        }
    </style>

    <div class="parallax-bg">
        <div class="container py-5 position-relative" style="z-index: 1;">
            <!-- Events Container -->
            <div id="eventsContainer"></div>
        </div>

        <!-- Event Details Modal -->
        <div class="modal fade" id="eventDetailsModal" tabindex="-1" aria-labelledby="eventDetailsModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventDetailsModalLabel">
                            <i class="bi bi-calendar-event me-2"></i>Event Details
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row event-details-row">
                            <div class="col-md-4 event-details-label">
                                <i class="bi bi-calendar-event me-2"></i>Event Name:
                            </div>
                            <div class="col-md-8 event-details-value" id="modalEventName"></div>
                        </div>
                        <div class="row event-details-row">
                            <div class="col-md-4 event-details-label">
                                <i class="bi bi-calendar-date me-2"></i>Date:
                            </div>
                            <div class="col-md-8 event-details-value" id="modalEventDate"></div>
                        </div>
                        <div class="row event-details-row">
                            <div class="col-md-4 event-details-label">
                                <i class="bi bi-mortarboard me-2"></i>Academic Year:
                            </div>
                            <div class="col-md-8 event-details-value" id="modalAcademicYear"></div>
                        </div>
                        <div class="row event-details-row">
                            <div class="col-md-4 event-details-label">
                                <i class="bi bi-people me-2"></i>Audience:
                            </div>
                            <div class="col-md-8 event-details-value" id="modalAudience"></div>
                        </div>
                        <div class="row event-details-row">
                            <div class="col-md-4 event-details-label">
                                <i class="bi bi-tag me-2"></i>Event Type:
                            </div>
                            <div class="col-md-8 event-details-value" id="modalEventType"></div>
                        </div>
                        <div class="row event-details-row">
                            <div class="col-md-4 event-details-label">
                                <i class="bi bi-card-text me-2"></i>Day:
                            </div>
                            <div class="col-md-8 event-details-value" id="modalDescription"></div>
                        </div>
                        <div class="row event-details-row">
                            <div class="col-md-4 event-details-label">
                                <i class="bi bi-paperclip me-2"></i>Attachment:
                            </div>
                            <div class="col-md-8" id="modalAttachment"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-2"></i>Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function formatDate(dateString) {
            if (!dateString) return 'N/A';
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                weekday: 'long'
            });
        }

        function getDay(dateString) {
            const date = new Date(dateString);
            return date.getDate();
        }

        function getShortMonthName(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', {
                month: 'short'
            });
        }

        function showEventModal(event) {
            document.getElementById('modalEventName').textContent = event.event_name || 'N/A';
            document.getElementById('modalEventDate').textContent = formatDate(event.start_date) +
                (event.end_date ? ` to ${formatDate(event.end_date)}` : '');
            document.getElementById('modalAcademicYear').textContent = event.academic_year || 'N/A';
            document.getElementById('modalAudience').textContent = event.audience || 'All';
            document.getElementById('modalEventType').textContent = event.event_type || 'N/A';
            document.getElementById('modalDescription').textContent = event.description || 'No description available';

            const attachmentDiv = document.getElementById('modalAttachment');
            attachmentDiv.innerHTML = '';

            if (event.attachment_url) {
                const ext = event.attachment_url.split('.').pop().toLowerCase();
                if (['jpg', 'jpeg', 'png', 'gif'].includes(ext)) {
                    attachmentDiv.innerHTML = `
                    <div class="text-center mt-2">
                        <img src="${event.attachment_url}" class="img-fluid rounded shadow-sm" alt="Event Attachment" style="max-height: 300px;">
                        <div class="mt-2">
                            <a href="${event.attachment_url}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-download me-1"></i>Download Image
                            </a>
                        </div>
                    </div>`;
                } else if (ext === 'pdf') {
                    attachmentDiv.innerHTML = `
                    <div class="mt-2">
                        <embed src="${event.attachment_url}#toolbar=0&navpanes=0"
                            type="application/pdf"
                            width="100%"
                            height="400px"
                            class="rounded shadow-sm border">
                        <div class="mt-2">
                            <a href="${event.attachment_url}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-download me-1"></i>Download PDF
                            </a>
                        </div>
                    </div>`;
                } else {
                    attachmentDiv.innerHTML = `
                    <div class="mt-2">
                        <a href="${event.attachment_url}" target="_blank" class="btn btn-outline-primary">
                            <i class="bi bi-download me-1"></i>Download Attachment
                        </a>
                    </div>`;
                }
            } else {
                attachmentDiv.innerHTML = '<span class="text-muted">No attachment available</span>';
            }

            const modal = new bootstrap.Modal(document.getElementById('eventDetailsModal'));
            modal.show();
        }

        function renderEvents(events) {
            const container = document.getElementById('eventsContainer');
            container.innerHTML = '';

            if (events.length === 0) {
                container.innerHTML =
                    '<div class="no-events"><i class="bi bi-calendar-x me-2"></i>No events found</div>';
                return;
            }

            // Define the academic month order (June to May)
            const academicMonthOrder = [
                'June', 'July', 'August', 'September', 'October',
                'November', 'December', 'January', 'February',
                'March', 'April', 'May'
            ];

            // Group events by event_type (case-insensitive)
            const groupedEvents = events.reduce((groups, event) => {
                const type = event.event_type ?
                    event.event_type.charAt(0).toUpperCase() + event.event_type.slice(1).toLowerCase() :
                    'Other';

                if (!groups[type]) groups[type] = [];
                groups[type].push(event);
                return groups;
            }, {});

            // Sort groups according to academic month order
            const sortedGroups = Object.entries(groupedEvents).sort((a, b) => {
                // If both are months in our academic order
                const aIndex = academicMonthOrder.indexOf(a[0]);
                const bIndex = academicMonthOrder.indexOf(b[0]);

                if (aIndex !== -1 && bIndex !== -1) {
                    return aIndex - bIndex;
                }

                // If only one is a month
                if (aIndex !== -1) return -1;
                if (bIndex !== -1) return 1;

                // If neither are months, sort alphabetically
                return a[0].localeCompare(b[0]);
            });

            // Render each event_type group
            sortedGroups.forEach(([type, eventsInType]) => {
                eventsInType.sort((a, b) => new Date(a.start_date) - new Date(b.start_date));

                const typeCard = document.createElement('div');
                typeCard.className = 'month-card';

                typeCard.innerHTML = `
            <div class="month-header">
                <h3><i class="bi bi-tags me-2"></i>${type}</h3>
            </div>
            <div class="event-list" id="type-${type.replace(/\s+/g, '-').toLowerCase()}"></div>
        `;

                container.appendChild(typeCard);

                const eventList = typeCard.querySelector('.event-list');

                eventsInType.forEach(event => {
                    const eventItem = document.createElement('div');
                    eventItem.className = 'event-item d-flex align-items-center';
                    eventItem.addEventListener('click', () => showEventModal(event));

                    eventItem.innerHTML = `
                <div class="event-date">
                    <div class="day">${getDay(event.start_date)}</div>
                    <div class="month">${getShortMonthName(event.start_date)}</div>
                </div>
                <div class="event-details flex-grow-1">
                    <h5 class="text-white mb-1">${event.event_name}</h5>
                    <p class="text-white-50 mb-0">
                       <i class="bi bi-calendar-day"></i> ${event.description || 'All'}
                        ${event.academic_year ? ` • <i class="bi bi-mortarboard-fill ms-2 me-1"></i> ${event.academic_year}` : ''}
                    </p>
                </div>
                <div class="ms-auto">
                    <i class="bi bi-chevron-right text-white"></i>
                </div>
            `;

                    eventList.appendChild(eventItem);
                });
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            function loadEvents() {
                fetch(`/academic-calendars/events`)
                    .then(response => response.json())
                    .then(data => {
                        renderEvents(data);
                    })
                    .catch(error => {
                        console.error('Error fetching events:', error);
                        document.getElementById('eventsContainer').innerHTML =
                            '<div class="no-events"><i class="bi bi-exclamation-triangle me-2"></i>Failed to load events. Please try again later.</div>';
                    });
            }

            loadEvents();
        });
    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
