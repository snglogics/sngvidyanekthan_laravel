@extends('layouts.admin')

@section('title', 'Create Live Class')
@section('breadcrumb-title', 'Faculty')
@section('breadcrumb-link', route('admin.faculties'))
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

@endsection

@section('content')
<h2 class="text-center text-primary mb-4">
    <i class="fas fa-chalkboard-teacher"></i> Create Live Class
</h2>

<form id="createForm" action="{{ route('admin.live-classes.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label"><i class="fas fa-heading me-1"></i> Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label"><i class="fas fa-align-left me-1"></i> Description</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label"><i class="fas fa-video me-1"></i> Platform</label>
        <select name="platform" class="form-control" required>
            <option value="Zoom" {{ old('platform') == 'Zoom' ? 'selected' : '' }}>Zoom</option>
            <option value="Google Meet" {{ old('platform') == 'Google Meet' ? 'selected' : '' }}>Google Meet</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label"><i class="fas fa-link me-1"></i> Meeting Link</label>
        <input type="url" name="link" class="form-control" value="{{ old('link') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label"><i class="fas fa-clock me-1"></i> Scheduled At</label>
        <input type="datetime-local" name="scheduled_at" class="form-control"
               value="{{ old('scheduled_at', now()->format('Y-m-d\TH:i')) }}" required>
    </div>

    <button type="submit" class="btn btn-primary w-100" id="submitBtn">
        <i class="fas fa-plus-circle me-1"></i> Create
    </button>
</form>

<hr class="my-5">

<h3 class="text-center mb-4"><i class="fas fa-calendar-alt"></i> Upcoming Live Classes</h3>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th><i class="fas fa-heading"></i> Title</th>
            <th><i class="fas fa-video"></i> Platform</th>
            <th><i class="fas fa-link"></i> Link</th>
            <th><i class="fas fa-clock"></i> Scheduled At</th>
            <th><i class="fas fa-cogs"></i> Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($classes as $class)
            <tr>
                <td>{{ $class->title }}</td>
                <td>{{ $class->platform }}</td>
                <td><a href="{{ $class->link }}" target="_blank"><i class="fas fa-sign-in-alt"></i> Join</a></td>
                <td>{{ \Carbon\Carbon::parse($class->scheduled_at)->format('d M Y, h:i A') }}</td>
                <td>
                    <a href="{{ route('admin.live-classes.edit', $class->id) }}" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>

                    <form action="{{ route('admin.live-classes.destroy', $class->id) }}" method="POST"
                          class="d-inline-block"
                          onsubmit="return confirm('Are you sure you want to delete this class?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">No live classes found.</td>
            </tr>
        @endforelse
    </tbody>
</table>


</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    const form = document.getElementById('createForm');
    const submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', () => {
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Creating...
        `;
    });

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}", "Validation Error");
        @endforeach
    @endif

    @if (session('success'))
        toastr.success("{{ session('success') }}", "Success");
    @elseif (session('error'))
        toastr.error("{{ session('error') }}", "Error");
    @endif
</script>
@endsection
