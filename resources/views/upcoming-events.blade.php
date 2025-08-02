@extends('layouts.layout')

@section('styles')
    <style>
        .parallax-bg {
            background-image: url('/frontend/images/aboutusImg.jpg');
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            padding: 30px;
            border-radius: 10px;
        }
        
        /* Event list container - prevent horizontal scroll */
        .event-list-container {
            max-height: 300px;
            overflow-y: auto;
            overflow-x: hidden; /* Prevent horizontal scroll */
            width: 100%;
        }
        
        .event-with-bg {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 15px;
            position: relative;
            color: white;
            cursor: pointer;
            transition: transform 0.3s ease;
            width: calc(100% - 40px); /* Account for padding */
            margin-left: 0;
            margin-right: 0;
        }
        
        .event-with-bg:hover {
            transform: scale(1.02);
        }
        
        .event-with-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            z-index: 0;
        }
        
        .event-content {
            position: relative;
            z-index: 1;
            padding-left: 15px; /* Added left padding */
            padding-right: 15px; /* Added right padding */
            word-wrap: break-word; /* Prevent long words from causing overflow */
        }
        
        /* Modal styles */
        .event-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.8);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        
        .modal-content {
            width: 80%;
            max-width: 900px;
            max-height: 90vh;
            overflow: auto;
            position: relative;
            background-size: cover;
            background-position: center;
            border-radius: 10px;
            padding: 30px;
            color: white;
            margin: 20px; /* Added margin for smaller screens */
            box-sizing: border-box; /* Include padding in width calculation */
        }
        
        .modal-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            z-index: 0;
        }
        
        .modal-body {
            position: relative;
            z-index: 1;
            padding: 20px;
            word-wrap: break-word; /* Prevent text overflow */
        }
        
        .close-modal {
            position: absolute;
            top: 15px;
            right: 15px;
            color: white;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            z-index: 2;
        }
        
        .close-modal:hover {
            color: #ccc;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .modal-content {
                width: 95%;
                padding: 15px;
            }
            
            .modal-body {
                padding: 10px;
            }
            
            .event-content {
                padding-left: 10px;
                padding-right: 10px;
            }
        }
    </style>
@endsection

@section('hero_title', 'Upcoming Events')

@section('content')
<div class="about-event mt-50">
    <div class="event-title">
        <h3>Upcoming events</h3>
    </div>

    <div class="event-list-container">
        <ul class="list-unstyled">
            @forelse($upcomingEvent as $event)
                <li class="mb-3">
                    <div class="singel-event event-with-bg" 
                         style="background-image: url('{{ $event->image_url }}')"
                         onclick="openEventModal('{{ $event->image_url }}', '{{ addslashes($event->heading) }}', '{{ \Carbon\Carbon::parse($event->event_date)->format('d F Y') }}', '{{ addslashes($event->time_interval) }}', '{{ addslashes($event->venue) }}', '{{ addslashes($event->description) }}')">
                        <div class="event-content">
                            <span><i class="fa fa-calendar"></i>
                                {{ \Carbon\Carbon::parse($event->event_date)->format('d F Y') }}</span>
                            <a href="#" style="color: white;">
                                <h4>{{ $event->heading }}</h4>
                            </a>
                            <span><i class="fa fa-clock-o"></i> {{ $event->time_interval }}</span>
                            <span><i class="fa fa-map-marker"></i> {{ $event->venue }}</span>
                        </div>
                    </div>
                </li>
            @empty
                <li>
                    <p>No upcoming events.</p>
                </li>
            @endforelse
        </ul>
    </div>
</div>

<!-- Event Modal -->
<div id="eventModal" class="event-modal">
    <div class="modal-content" id="modalContent">
        <span class="close-modal" onclick="closeEventModal()">&times;</span>
        <div class="modal-body">
            <h2 id="modalEventTitle"></h2>
            <p><i class="fa fa-calendar"></i> <span id="modalEventDate"></span></p>
            <p><i class="fa fa-clock-o"></i> <span id="modalEventTime"></span></p>
            <p><i class="fa fa-map-marker"></i> <span id="modalEventVenue"></span></p>
            <p id="modalEventDescription"></p>
        </div>
    </div>
</div>

<script>
    function openEventModal(imageUrl, title, date, time, venue, description) {
        const modal = document.getElementById('eventModal');
        const modalContent = document.getElementById('modalContent');
        
        // Set the background image and content
        modalContent.style.backgroundImage = `url('${imageUrl}')`;
        document.getElementById('modalEventTitle').textContent = title;
        document.getElementById('modalEventDate').textContent = date;
        document.getElementById('modalEventTime').textContent = time;
        document.getElementById('modalEventVenue').textContent = venue;
        document.getElementById('modalEventDescription').textContent = description;
        
        // Show the modal
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden'; // Prevent scrolling
    }
    
    function closeEventModal() {
        document.getElementById('eventModal').style.display = 'none';
        document.body.style.overflow = 'auto'; // Re-enable scrolling
    }
    
    // Close modal when clicking outside the content
    window.onclick = function(event) {
        const modal = document.getElementById('eventModal');
        if (event.target === modal) {
            closeEventModal();
        }
    }
</script>
@endsection