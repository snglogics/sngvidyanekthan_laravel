@extends('layouts.admin')

@section('title', 'Add New Academic Event')

@section('content')
<div class="card shadow p-4">
    <h3 class="mb-4"><i class="bi bi-calendar-plus me-2"></i> Add New Academic Event</h3>

    <form action="{{ route('admin.academic-calendars.store') }}" method="POST" enctype="multipart/form-data" id="eventForm">
        @csrf

        <div class="mb-3">
            <label class="form-label"><i class="bi bi-pencil-square me-1"></i> Event Name</label>
            <input type="text" name="event_name" class="form-control" placeholder="Enter event name" required>
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="bi bi-chat-left-text me-1"></i> Description</label>
            <textarea name="description" class="form-control" rows="3" placeholder="Brief description of the event"></textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label"><i class="bi bi-calendar-event me-1"></i> Start Date</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label"><i class="bi bi-calendar-check me-1"></i> End Date</label>
                <input type="date" name="end_date" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="bi bi-tags me-1"></i> Event Type</label>
            <input type="text" name="event_type" class="form-control" placeholder="Workshop, Seminar, etc." required>
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="bi bi-journal-bookmark me-1"></i> Academic Year</label>
            <input type="text" name="academic_year" class="form-control" placeholder="e.g. 2024-2025" required>
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="bi bi-people me-1"></i> Audience</label>
            <input type="text" name="audience" class="form-control" placeholder="Students, Faculty, All">
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="bi bi-palette me-1"></i> Color</label>
            <input type="color" name="color" class="form-control form-control-color" value="#007bff" title="Choose event color">
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="bi bi-paperclip me-1"></i> Attachment (Optional)</label>
            <input type="file" name="attachment" class="form-control">
            <div class="progress mt-2" style="display: none;" id="uploadProgress">
                <div class="progress-bar" role="progressbar" style="width: 0%;" id="uploadProgressBar">0%</div>
            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save2 me-1"></i> Save Event
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<!-- Add any custom JS for file upload progress here if needed -->


<script>
//     document.getElementById('eventForm').addEventListener('submit', function(e) {
//         e.preventDefault();

//         const form = e.target;
//         const submitBtn = document.getElementById('submitBtn');
//         const progressBar = document.getElementById('uploadProgress');
//         const progressLabel = document.getElementById('uploadProgressBar');
        
//         // Disable button and show progress bar
//         submitBtn.disabled = true;
//         submitBtn.textContent = 'Saving...';
//         progressBar.style.display = 'block';

//         // Prepare the form data
//         const formData = new FormData(form);

//         // Send the AJAX request
//         fetch(form.action, {
//             method: 'POST',
//             body: formData,
//             headers: {
//                 'X-CSRF-TOKEN': "{{ csrf_token() }}"
//             }
//         })
//         .then(response => response.json())
//         .then(data => {
//             if (data.success) {
//                 // Redirect or show success message
//                 window.location.href = "{{ route('admin.academic-calendars.index') }}";
//             } else {
//                 alert("Error: " + data.message);
//                 submitBtn.disabled = false;
//                 submitBtn.textContent = 'Save Event';
//                 progressBar.style.display = 'none';
//             }
//         })
//         .catch(error => {
//             console.error("Error:", error);
//             alert("An unexpected error occurred. Please try again.");
//             submitBtn.disabled = false;
//             submitBtn.textContent = 'Save Event';
//             progressBar.style.display = 'none';
//         });

//         // Simulate file upload progress
//         const interval = setInterval(() => {
//             let progress = parseInt(progressLabel.textContent);
//             if (progress < 90) {
//                 progress += 10;
//                 progressLabel.style.width = progress + '%';
//                 progressLabel.textContent = progress + '%';
//             } else {
//                 clearInterval(interval);
//             }
//         }, 300);
//     });
// </script>
@endsection