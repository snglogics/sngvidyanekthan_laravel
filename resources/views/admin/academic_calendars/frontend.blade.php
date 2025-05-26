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

    .event-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(8px);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .event-card h5, .event-card p {
        color: #fff;
    }

    .modal-content {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(5px);
    }

    .bg-gradient-primary {
        background: linear-gradient(to right, #007bff, #0056b3);
    }
</style>

<div class="parallax-bg">
    <div class="container py-5 position-relative" style="z-index: 1;">

        <!-- Event Details Modal -->
        <div class="modal fade" id="eventDetailsModal" tabindex="-1" aria-labelledby="eventDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <div class="modal-header bg-gradient-primary text-white rounded-top-4">
                        <h5 class="modal-title fs-4" id="eventDetailsModalLabel">
                            <i class="bi bi-calendar-event-fill me-2"></i> Event Details
                        </h5>
                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <h4 id="modalEventName" class="fw-bold text-primary mb-3"></h4>
                        <p><i class="bi bi-calendar3"></i> <strong>Date:</strong> <span id="modalEventDate"></span></p>
                        <p><i class="bi bi-mortarboard-fill"></i> <strong>Academic Year:</strong> <span id="modalAcademicYear"></span></p>
                        <p><i class="bi bi-people-fill"></i> <strong>Audience:</strong> <span id="modalAudience"></span></p>
                        <p><i class="bi bi-card-text"></i> <strong>Description:</strong></p>
                        <p id="modalDescription" class="border rounded p-3 bg-light text-dark"></p>
                        <div id="modalAttachment" class="mt-4"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Events List -->
        <div id="eventsContainer" class="row gy-4"></div>

    </div>
</div>
@endsection

@section('scripts')
<script>
function showEventModal(event) {
    document.getElementById('modalEventName').textContent = event.event_name || 'N/A';
    document.getElementById('modalEventDate').textContent = `${event.start_date || 'N/A'} to ${event.end_date || 'N/A'}`;
    document.getElementById('modalAcademicYear').textContent = event.academic_year || 'N/A';
    document.getElementById('modalAudience').textContent = event.audience || 'N/A';
    document.getElementById('modalDescription').textContent = event.description || 'N/A';

    const attachmentDiv = document.getElementById('modalAttachment');
    attachmentDiv.innerHTML = '';

    if (event.attachment_url) {
        const ext = event.attachment_url.split('.').pop().toLowerCase();
        if (['jpg', 'jpeg', 'png'].includes(ext)) {
            attachmentDiv.innerHTML = `<img src="${event.attachment_url}" class="img-fluid rounded shadow-sm" alt="Attachment Image">`;
        } else if (ext === 'pdf') {
            attachmentDiv.innerHTML = `<embed src="${event.attachment_url}" type="application/pdf" width="100%" height="500px" class="rounded shadow-sm"/>`;
        } else {
            attachmentDiv.innerHTML = `<a href="${event.attachment_url}" target="_blank" class="btn btn-outline-primary">
                <i class="bi bi-download"></i> Download Attachment</a>`;
        }
    } else {
        attachmentDiv.innerHTML = `<p class="text-muted"><i class="bi bi-file-earmark-x"></i> No attachment available.</p>`;
    }

    new bootstrap.Modal(document.getElementById('eventDetailsModal')).show();
}

document.addEventListener('DOMContentLoaded', function () {
    function loadEvents() {
        fetch(`/academic-calendars/events`)
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('eventsContainer');
                container.innerHTML = '';

                if (data.length === 0) {
                    container.innerHTML = '<p class="text-center text-muted">No events found.</p>';
                    return;
                }

                data.forEach((event, index) => {
                    const card = document.createElement('div');
                    card.classList.add('col-md-4');

                    const bgImage = event.attachment_url || 'https://via.placeholder.com/400x200';

                  card.innerHTML = `
  <div class="event-card text-white">
    <div style="
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0,0,0,0.7)),
        url('${bgImage}');
        background-size: cover;
        background-position: center;
        height: 250px;
        padding: 1rem;
        display: flex;
        flex-direction: column;
        justify-content: end;
    ">
        <h5 class="fw-bold">${event.event_name}</h5>
        <p class="mb-1 small">
            <i class="bi bi-calendar2-week me-1"></i> ${event.start_date} to ${event.end_date || 'N/A'}<br>
            <i class="bi bi-people-fill me-1"></i> ${event.audience || 'N/A'}
        </p>
        <button class="btn btn-sm btn-light text-primary fw-semibold mt-2 view-details-btn" data-index="${index}">
            <i class="bi bi-eye-fill"></i> View Details
        </button>
    </div>
  </div>
`;

                    container.appendChild(card);
                });

                // Add event listeners to buttons
                document.querySelectorAll('.view-details-btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
        const idx = parseInt(btn.getAttribute('data-index'));
        const eventData = data[idx];
        showEventModal(eventData);
    });
});
            })
            .catch(error => {
                console.error('Error fetching events:', error);
                document.getElementById('eventsContainer').innerHTML =
                    '<p class="text-center text-danger">Failed to load events. Please try again later.</p>';
            });
    }

    loadEvents();
});

</script>

<!-- Bootstrap Icons (Optional: can be in layout) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
