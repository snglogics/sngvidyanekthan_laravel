@extends('layouts.admin')

@section('title', 'Add Campus Overview')
@section('breadcrumb-title', 'About')
@section('breadcrumb-link', route('admin.about'))

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
    .card {
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        border: none;
        border-radius: 12px;
    }
    .form-control:focus {
        box-shadow: none;
        border-color: #0d6efd;
    }
    .icon-label {
        display: flex;
        align-items: center;
        font-weight: 600;
    }
    .icon-label i {
        margin-right: 8px;
        color: #0d6efd;
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="card p-4">
        <h2 class="text-center mb-4 fw-bold text-primary">
            <i class="bi bi-building-add me-2"></i>Add New Campus Overview
        </h2>
        <form action="{{ route('admin.campus-overviews.store') }}" method="POST" enctype="multipart/form-data" id="campusForm">
            @csrf
            <div class="mb-3">
                <label class="icon-label"><i class="bi bi-type"></i>Main Heading</label>
                <input type="text" name="main_heading" class="form-control" placeholder="Enter heading..." required>
            </div>
            <div class="mb-3">
                <label class="icon-label"><i class="bi bi-card-text"></i>Description</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Write a description..." required></textarea>
            </div>

            <div class="mb-3">
                <label class="icon-label"><i class="bi bi-image"></i>Photos</label>
                <div id="photoInputs">
                    <div class="row g-2 mb-2">
                        <div class="col-md-6">
                            <input type="file" name="photos[]" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="photo_titles[]" class="form-control" placeholder="Photo Title">
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-outline-secondary mb-2" id="addPhotoBtn">
                    <i class="bi bi-plus-circle me-1"></i> Add More Photos
                </button>
                <div class="text-muted small"><i class="bi bi-info-circle me-1"></i>You can add multiple photos with titles.</div>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-4" id="submitBtn">
                <i class="bi bi-save2 me-1"></i>
                <span id="submitText">Save Overview</span>
            </button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('addPhotoBtn').addEventListener('click', function () {
        const inputGroup = document.createElement('div');
        inputGroup.classList.add('row', 'g-2', 'mb-2');

        inputGroup.innerHTML = `
            <div class="col-md-6">
                <input type="file" name="photos[]" class="form-control" required>
            </div>
            <div class="col-md-5">
                <input type="text" name="photo_titles[]" class="form-control" placeholder="Photo Title">
            </div>
            <div class="col-md-1 text-end">
                <button type="button" class="btn btn-danger btn-sm w-100 removeBtn">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
        `;

        inputGroup.querySelector('.removeBtn').addEventListener('click', function () {
            inputGroup.remove();
        });

        document.getElementById('photoInputs').appendChild(inputGroup);
    });

    document.getElementById('campusForm').addEventListener('submit', function (e) {
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');

        submitBtn.disabled = true;
        submitText.innerHTML = '<i class="bi bi-upload me-1"></i>Uploading...';

        requestAnimationFrame(() => {
            setTimeout(() => {
                this.submit();
            }, 0);
        });

        e.preventDefault();
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection
