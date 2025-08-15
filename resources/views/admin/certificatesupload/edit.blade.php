@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm rounded">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Edit Certificate</h5>
                </div>

                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="updateForm" action="{{ route('admin.certificates.update', $certificate->id) }}" method="POST" enctype="multipart/form-data" class="mt-3">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Certificate Title</label>
                            <input type="text" class="form-control" id="title" name="title" 
                                   value="{{ old('title', $certificate->title) }}" placeholder="Enter certificate title" required>
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- File Upload -->
                        <div class="mb-3">
                            <label for="pdf" class="form-label">Replace PDF File (optional)</label>
                            <input type="file" class="form-control" id="pdf" name="pdf" accept=".pdf">
                            <small class="form-text text-muted d-block mt-1">
                                Current file: 
                                <a href="{{ $certificate->pdf_url }}" target="_blank" class="text-decoration-underline">
                                    {{ basename($certificate->pdf_url) }}
                                </a>
                            </small>
                            @error('pdf')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.certificates.index') }}" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                            <button type="submit" id="updateButton" class="btn btn-primary">
                                <span id="buttonText">Update Certificate</span>
                                <span id="spinner" class="spinner-border spinner-border-sm d-none ms-2" role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('updateForm').addEventListener('submit', function() {
    const button = document.getElementById('updateButton');
    const buttonText = document.getElementById('buttonText');
    const spinner = document.getElementById('spinner');
    
    button.disabled = true;
    buttonText.textContent = 'Updating...';
    spinner.classList.remove('d-none');
});
</script>
@endsection
