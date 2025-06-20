@extends('layouts.admin')

@section('title', 'Add School Bus Route')
@section('breadcrumb-title', 'Add School Bus Route')
@section('breadcrumb-link', route('admin.faculties'))
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endsection

@section('content')
<div class="container py-5">
    <div class="card shadow rounded-4 border-0">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h4 class="mb-0 d-flex align-items-center">
                <i class="bi bi-bus-front me-2 fs-4"></i> Add School Bus Route
            </h4>
        </div>

        <div class="card-body px-4">
            @if($errors->any())
                <div class="alert alert-danger rounded-3">
                    <h6><i class="bi bi-exclamation-triangle-fill me-1"></i> Please fix the following issues:</h6>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.school_bus_routes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="route_name" class="form-label fw-semibold">
                        <i class="bi bi-signpost-split me-1"></i> Route Name
                    </label>
                    <input type="text" name="route_name" id="route_name" class="form-control rounded-3" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label fw-semibold">
                        <i class="bi bi-card-text me-1"></i> Description
                    </label>
                    <textarea name="description" id="description" class="form-control rounded-3" rows="4"></textarea>
                </div>

                <div class="mb-4">
                    <label for="stops" class="form-label fw-semibold">
                        <i class="bi bi-geo-alt-fill me-1"></i> Stops <small class="text-muted">(comma separated)</small>
                    </label>
                    <textarea name="stops[]" id="stops" class="form-control rounded-3" rows="3"></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="driver_name" class="form-label fw-semibold">
                            <i class="bi bi-person-fill me-1"></i> Driver Name
                        </label>
                        <input type="text" name="driver_name" id="driver_name" class="form-control rounded-3" required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="driver_contact" class="form-label fw-semibold">
                            <i class="bi bi-telephone-fill me-1"></i> Driver Contact
                        </label>
                        <input type="text" name="driver_contact" id="driver_contact" class="form-control rounded-3" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="bus_number" class="form-label fw-semibold">
                            <i class="bi bi-hash me-1"></i> Bus Number
                        </label>
                        <input type="text" name="bus_number" id="bus_number" class="form-control rounded-3" required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="bus_image" class="form-label fw-semibold">
                            <i class="bi bi-image me-1"></i> Bus Image
                        </label>
                        <input type="file" name="bus_image" id="bus_image" class="form-control rounded-3">
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100 py-2 rounded-3" id="submitBtn">
    <i class="bi bi-plus-circle me-1"></i> Add Route
</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector("form");
        const submitBtn = document.getElementById("submitBtn");

        form.addEventListener("submit", function () {
            submitBtn.disabled = true;
            submitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Adding Route`;
        });
    });
</script>
@endsection
