@extends('layouts.layout')

@section('title', 'Academic Events')

@section('content')
<div class="container py-5">
    <h2 class="text-center text-primary mb-4">Academic Events</h2>

    <!-- Event Details Modal -->
    <div class="modal fade" id="eventDetailsModal" tabindex="-1" aria-labelledby="eventDetailsModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="eventDetailsModalLabel"><i class="bi bi-calendar-event-fill me-2"></i>Event Details</h5>
            <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h4 id="modalEventName" class="fw-bold text-primary mb-3"></h4>
            <p><i class="bi bi-calendar3"></i> <strong>Date:</strong> <span id="modalEventDate"></span></p>
            <p><i class="bi bi-mortarboard-fill"></i> <strong>Academic Year:</strong> <span id="modalAcademicYear"></span></p>
            <p><i class="bi bi-people-fill"></i> <strong>Audience:</strong> <span id="modalAudience"></span></p>
            <p><i class="bi bi-card-text"></i> <strong>Description:</strong></p>
            <p id="modalDescription" class="border rounded p-3 bg-light"></p>
            <div id="modalAttachment" class="mt-4"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Events List -->
    <div id="eventsContainer" class="row"></div>
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
            attachmentDiv.innerHTML = `<a href="${event.attachment_url}" target="_blank" class="btn btn-outline-primary"><i class="bi bi-download"></i> Download Attachment</a>`;
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
                                <button class="btn btn-light btn-sm" onclick='showEventModal(${JSON.stringify(event)})'>
                                    <i class="bi bi-eye-fill"></i> View Details
                                </button>
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
});
</script>

<!-- Bootstrap Icons (Add to layout or here) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
