@extends('layouts.admin')

@section('title', 'Upload Sliders')

@section('styles')
<link href="{{ asset('frontend/css/uploadPrincipal.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> 
   
@endsection

@section('content')
<div class="card p-4">
    <h2 class="text-center mb-4 fw-bold text-primary" data-aos="zoom-in">Manage Sliders</h2>

    {{-- ✅ Show success message --}}
    @if(session('success'))
        <div class="alert alert-success text-center" data-aos="fade-down">
            <p class="mb-0">{{ session('success') }}</p>
        </div>
    @endif

    <div class="table-responsive" data-aos="fade-up" data-aos-delay="200">
    <table class="table table-hover table-striped table-bordered shadow-sm text-center align-middle rounded overflow-hidden">
    <thead class="bg-primary text-white">
        <tr class="fw-semibold">
          
            <th scope="col">Image</th>
            <th scope="col">Heading</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach (['slider1', 'slider2', 'slider3'] as $slider)
        <tr>
           
            <td>
                <label for="{{ $slider }}" class="cursor-pointer">
                    <img id="preview_{{ $slider }}" 
                         src="{{ $images[$slider] ?? 'https://cdn-icons-png.flaticon.com/512/847/847969.png' }}" 
                         alt="{{ $slider }}" 
                         style="width: 120px; height: 120px; object-fit: cover; border-radius: 10px; border: 2px dashed #ccc;" />
                </label>
                <input type="file" id="{{ $slider }}" name="{{ $slider }}" class="d-none file-upload" data-slider="{{ $slider }}" accept="image/*">
            </td>
            <td class="fw-bold">
                
                <input type="text" class="form-control" id="{{ $slider }}_heading"
                    placeholder="Enter heading"
                    value="{{ $images[$slider . '_heading'] ?? '' }}">
            </td>
            <td>
                <textarea class="form-control" id="{{ $slider }}_description"
                    placeholder="Enter description"
                    rows="3">{{ $images[$slider . '_description'] ?? '' }}</textarea>
            </td>
            <td>
                <button type="button" class="btn btn-success upload-btn w-100" data-slider="{{ $slider }}">
                    <i class="bi bi-upload"></i> Upload
                </button>
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
    document.querySelectorAll('.file-upload').forEach(input => {
        input.addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                const preview = document.getElementById(`preview_${event.target.dataset.slider}`);
                preview.src = URL.createObjectURL(file);
            }
        });
    });

    document.querySelectorAll('.upload-btn').forEach(button => {
        button.addEventListener('click', async function() {
            const slider = button.dataset.slider;
            const fileInput = document.getElementById(slider);

            if (!fileInput.files.length) {
                alert('Please select an image first.');
                return;
            }

            const formData = new FormData();
            formData.append('image', fileInput.files[0]);
            formData.append('slider', slider);

            // ✅ Add heading and description
            const headingInput = document.getElementById(`${slider}_heading`);
            const descriptionInput = document.getElementById(`${slider}_description`);
            formData.append('heading', headingInput ? headingInput.value : '');
            formData.append('description', descriptionInput ? descriptionInput.value : '');

            button.disabled = true;
            button.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Uploading';

            try {
    const response = await fetch("{{ route('slider.upload') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        body: formData
    });

    const contentType = response.headers.get("content-type");

    if (contentType && contentType.includes("application/json")) {
        const result = await response.json();

        if (result.success) {
            toastr.success(result.message, 'Success');
        } else {
            toastr.error(result.message || 'Upload failed.', 'Error');
        }
    } else {
        const errorText = await response.text();
        console.error('Non-JSON response:', errorText);
        toastr.error('Unexpected error. See console for details.', 'Error');
    }
} catch (error) {
    console.error('Upload Error:', error);
    toastr.error('Something went wrong during upload.', 'Error');
}

            button.disabled = false;
            button.innerHTML = 'Upload';
        });
    });
</script>
@endsection
