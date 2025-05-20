@extends('layouts.admin')

@section('title', 'Edit Magazine')
@section('breadcrumb-title', 'Edit Magazine')
@section('breadcrumb-link', route('admin.magazines.index'))

@section('styles')
<link href="{{ asset('frontend/css/uploadPrincipal.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
    .spinner-border {
        width: 1.3rem;
        height: 1.3rem;
        margin-left: 8px;
    }
    .card {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.08);
        border-radius: 10px;
    }
    .form-label i {
        color: #6c757d;
        margin-right: 5px;
    }
</style>
@endsection

@section('content')

<div class="container py-4">
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Magazine - {{ $magazine->title }}</h4>
            <a href="{{ route('admin.magazines.index') }}" class="btn btn-light btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
        </div>
        <div class="card-body">
            <form id="update-magazine-form" action="{{ route('admin.magazines.update', $magazine->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Magazine Title --}}
                <div class="mb-3">
                    <label for="title" class="form-label"><i class="fas fa-heading"></i> Title</label>
                    <input type="text" name="title" value="{{ old('title', $magazine->title) }}" class="form-control" required placeholder="Enter magazine title">
                </div>

                {{-- PDF File --}}
                <div class="mb-3">
                    <label for="pdf" class="form-label"><i class="fas fa-file-pdf"></i> Upload PDF <small class="text-muted">(Optional)</small></label>
                    <input type="file" name="pdf" class="form-control" accept="application/pdf">
                    <div class="form-text">Leave blank to keep the existing PDF.</div>
                </div>

                {{-- Existing PDF Preview --}}
                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-eye"></i> Current PDF:</label><br>
                    <a href="{{ $magazine->pdf_url }}" target="_blank" class="btn btn-sm btn-outline-info">
                        <i class="fas fa-file-pdf me-1"></i> View Current PDF
                    </a>
                </div>

                {{-- Buttons --}}
                <div class="d-flex align-items-center gap-2">
                    <button type="submit" class="btn btn-success" id="update-btn">
                        <i class="fas fa-save me-1"></i> Update Magazine
                        <span id="update-spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                    <a href="{{ route('admin.magazines.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.getElementById('update-magazine-form').addEventListener('submit', function () {
        const btn = document.getElementById('update-btn');
        const spinner = document.getElementById('update-spinner');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Updating...';
        spinner.classList.remove('d-none');
    });
</script>
@endsection
