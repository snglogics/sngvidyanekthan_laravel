@extends('layouts.admin')

@section('title', 'Create Timetable')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-primary text-center">Add New Timetable Entry</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="timetableForm">
    @csrf
    <div class="mb-3">
        <label for="classname" class="form-label">Class</label>
        <input type="text" name="classname" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="section" class="form-label">Section</label>
        <input type="text" name="section" class="form-control">
    </div>

    <div class="mb-3">
        <label for="day" class="form-label">Day</label>
        <select name="day" class="form-control" required>
            <option value="">Select a day</option>
            @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'] as $day)
                <option value="{{ $day }}">{{ $day }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="period_number" class="form-label">Period Number</label>
        <input type="number" name="period_number" class="form-control" required min="1">
    </div>

    <div class="mb-3">
        <label for="subject" class="form-label">Subject</label>
        <input type="text" name="subject" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="teacher_name" class="form-label">Teacher Name</label>
        <input type="text" name="teacher_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="start_time" class="form-label">Start Time</label>
        <input type="time" name="start_time" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="end_time" class="form-label">End Time</label>
        <input type="time" name="end_time" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="room_number" class="form-label">Room Number (optional)</label>
        <input type="text" name="room_number" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary w-100" id="submitBtn">Save Timetable</button>
</form>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    const form = document.getElementById('timetableForm');
    const submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        submitBtn.disabled = true;
        submitBtn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...`;

        const formData = new FormData(form);

        try {
            const response = await fetch("{{ route('admin.timetables.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: formData
            });

            const result = await response.json();

            if (response.ok && result.success) {
                toastr.success(result.message || "Saved successfully.");
                form.reset();
            } else if (response.status === 422) {
                let errors = result.errors;
                Object.values(errors).forEach(errArr => {
                    errArr.forEach(err => toastr.error(err, "Validation Error"));
                });
            } else {
                toastr.error(result.message || "Something went wrong.");
            }
        } catch (err) {
            toastr.error("Unexpected error occurred.");
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = "Save Timetable";
        }
    });
</script>

@endsection
