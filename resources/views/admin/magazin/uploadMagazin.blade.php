@extends('layouts.admin')

@section('title', 'Manage Announcements')
@section('breadcrumb-title', 'Magazine Gallery')
@section('breadcrumb-link', route('admin.galleries'))

@section('styles')
<link href="{{ asset('frontend/css/uploadPrincipal.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<style>
    .spinner-border {
        width: 1.5rem;
        height: 1.5rem;
        vertical-align: text-bottom;
        margin-left: 10px;
    }

    .form-control {
        border-radius: 0.5rem;
    }

    .btn i {
        margin-right: 5px;
    }

    .card {
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    .table-hover tbody tr:hover {
        background-color: #f6f9fc;
    }

    .table td, .table th {
        vertical-align: middle;
    }
</style>
@endsection

@section('content')

<div class="card mb-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-cloud-upload-fill"></i> Upload New Magazine</h5>
    </div>
    <div class="card-body">
        <form id="magazine-upload-form" action="{{ route('admin.magazines.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">Magazine Title</label>
                    <input type="text" name="title" placeholder="Enter title" required class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="pdf" class="form-label">Upload PDF</label>
                    <input type="file" name="pdf" accept="application/pdf" required class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-success" id="upload-btn">
                <i class="bi bi-upload"></i> Upload Magazine
                <span id="upload-spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            </button>
        </form>
    </div>
</div>

@if($magazines->count())
    <div class="card">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0"><i class="bi bi-journals"></i> Uploaded Magazines</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>PDF</th>
                            <th>Uploaded At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($magazines as $index => $magazine)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $magazine->title }}</td>
                                <td>
                                    <a href="{{ $magazine->pdf_url }}" target="_blank" class="btn btn-outline-info btn-sm">
                                        <i class="bi bi-file-earmark-pdf"></i> View PDF
                                    </a>
                                </td>
                                <td>{{ $magazine->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.magazines.edit', $magazine->id) }}" class="btn btn-warning btn-sm me-1">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.magazines.destroy', $magazine->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this magazine?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@else
    <div class="alert alert-info mt-3">
        <i class="bi bi-info-circle"></i> No magazines uploaded yet.
    </div>
@endif

@endsection

@section('scripts')
<script>
    document.getElementById('magazine-upload-form').addEventListener('submit', function () {
        const btn = document.getElementById('upload-btn');
        const spinner = document.getElementById('upload-spinner');
        btn.disabled = true;
        btn.innerHTML = '<i class="bi bi-arrow-repeat"></i> Uploading...';
        spinner.classList.remove('d-none');
    });
</script>
@endsection
