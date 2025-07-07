@extends('layouts.admin')

@section('title', 'Manage Announcements')
@section('breadcrumb-title', 'Home')
@section('breadcrumb-link', route('admin.home'))
@section('styles')
    <link href="{{ asset('frontend/css/uploadPrincipal.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

@section('content')
    <div class="card p-4">
        <h2 class="text-center mb-4 fw-bold text-primary" data-aos="zoom-in">Manage Announcements</h2>

        @if (session('success'))
            <div class="alert alert-success text-center" data-aos="fade-down">
                <p class="mb-0">{{ session('success') }}</p>
            </div>
        @endif

        {{-- Add Announcement Section --}}
        <div class="mb-4" data-aos="fade-up">
            <button type="button" class="btn btn-success mb-3" id="addFileBtn">Add File</button>
            <form id="announcementForm" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label fw-bold">Announcement Header</label>
                    <input type="text" name="announcement_header" class="form-control"
                        placeholder="Enter Announcement Header" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description" class="form-control" placeholder="Enter Description" rows="4" required></textarea>
                </div>

                <div id="fileInputs" class="d-flex flex-column gap-3"></div>

                <button type="submit" id="uploadButton" class="btn btn-primary mt-3">Upload Announcement</button>
            </form>
        </div>

        {{-- Existing Announcements Table --}}
        <div class="table-responsive" data-aos="fade-up" data-aos-delay="200">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Header</th>
                        <th>Description</th>
                        <th>Files</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($announcements as $announcement)
                        <tr>
                            <td class="fw-bold">{{ $announcement->header }}</td>
                            <td>{{ $announcement->description }}</td>
                            <td>
                                @foreach ($announcement->files as $file)
                                    <a href="{{ $file->file_url }}" target="_blank" class="d-block mb-1">View File</a>
                                @endforeach
                            </td>
                            <td>
                                <!-- <a href="{{ route('announcement.edit', $announcement->id) }}" class="btn btn-warning btn-sm">Edit</a> -->
                                <form action="{{ route('announcement.delete', $announcement->id) }}" method="POST"
                                    class="d-inline-block"
                                    onsubmit="return confirm('Are you sure you want to delete this announcement?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const fileInputs = document.getElementById('fileInputs');
        const addFileBtn = document.getElementById('addFileBtn');

        addFileBtn.addEventListener('click', () => {
            const inputGroup = document.createElement('div');
            inputGroup.classList.add('d-flex', 'gap-2', 'align-items-center');

            inputGroup.innerHTML = `
            <input type="file" name="documents[]" accept=".pdf,.doc,.docx" class="form-control" required>
            <button type="button" class="btn btn-danger remove-btn">Remove</button>
        `;

            fileInputs.appendChild(inputGroup);

            inputGroup.querySelector('.remove-btn').addEventListener('click', () => {
                inputGroup.remove();
            });
        });

        document.getElementById('announcementForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const submitBtn = document.getElementById('uploadButton');

            // Change button text and disable it
            submitBtn.textContent = 'Uploading...';
            submitBtn.disabled = true;

            try {
                const response = await fetch("{{ route('announcement.upload') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: formData
                });

                const result = await response.json();

                if (result.success) {
                    toastr.success(result.message, 'Success');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    toastr.error(result.message || 'Upload failed.', 'Error');
                }
            } catch (error) {
                console.error('Upload Error:', error);
                toastr.error('Something went wrong.', 'Error');
            } finally {
                // Reset button text and re-enable it
                submitBtn.textContent = 'Upload Announcement';
                submitBtn.disabled = false;
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection
