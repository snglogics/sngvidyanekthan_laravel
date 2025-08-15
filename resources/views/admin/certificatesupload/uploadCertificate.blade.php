@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm rounded">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Certificates Management</h5>
                </div>

                <div class="card-body">
                    <!-- Upload Form -->
                    <div class="mb-4 pb-3 border-bottom">
                        <h6 class="fw-bold mb-3">Upload New Certificate</h6>
                        <form id="uploadForm" action="{{ route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="title" class="form-label">Certificate Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter certificate title" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="pdf" class="form-label">PDF File</label>
                                    <input type="file" class="form-control" id="pdf" name="pdf" accept=".pdf" required>
                                    <small class="form-text text-muted">Max 100MB PDF file</small>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" id="uploadButton" class="btn btn-primary">
                                    <span id="buttonText">Upload Certificate</span>
                                    <span id="spinner" class="spinner-border spinner-border-sm d-none ms-2" role="status" aria-hidden="true"></span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Alerts -->
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <!-- Certificates List -->
                    <h6 class="fw-bold mb-3">Existing Certificates</h6>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Title</th>
                                    <th>Uploaded</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($certificates as $certificate)
                                    <tr>
                                        <td>{{ $certificate->title }}</td>
                                        <td>{{ $certificate->created_at->format('M d, Y') }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.certificates.edit', $certificate->id) }}" class="btn btn-sm btn-info me-1">Edit</a>
                                            <a href="{{ route('certificates.download', $certificate->id) }}" class="btn btn-sm btn-success me-1">Download</a>
                                            <form action="{{ route('admin.certificates.destroy', $certificate->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">No certificates uploaded yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('uploadForm').addEventListener('submit', function() {
    const button = document.getElementById('uploadButton');
    const buttonText = document.getElementById('buttonText');
    const spinner = document.getElementById('spinner');
    
    button.disabled = true;
    buttonText.textContent = 'Uploading...';
    spinner.classList.remove('d-none');
});
</script>
@endsection
