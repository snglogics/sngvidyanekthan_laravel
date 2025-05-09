@extends('layouts.admin')

@section('title', 'Add Campus Overview')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Add New Campus Overview</h2>
    <form action="{{ route('admin.campus-overviews.store') }}" method="POST" enctype="multipart/form-data" id="campusForm">
        @csrf
        <div class="mb-3">
            <label>Main Heading</label>
            <input type="text" name="main_heading" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>
        
        <!-- Dynamic Photo Upload -->
        <div class="mb-3">
            <label>Photos</label>
            <div id="photoInputs">
                <div class="mb-2">
                    <input type="file" name="photos[]" class="form-control mb-2" required>
                    <input type="text" name="photo_titles[]" class="form-control mb-2" placeholder="Photo Title">
                </div>
            </div>
            <button type="button" class="btn btn-outline-secondary" id="addPhotoBtn">Add More Photos</button>
            <small class="text-muted d-block">You can add multiple photos with titles.</small>
        </div>

        <button type="submit" class="btn btn-primary w-100" id="submitBtn">Save Overview</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('addPhotoBtn').addEventListener('click', function() {
        const inputContainer = document.createElement('div');
        inputContainer.classList.add('mb-2');
        
        const inputFile = document.createElement('input');
        inputFile.type = 'file';
        inputFile.name = 'photos[]';
        inputFile.classList.add('form-control', 'mb-2');
        inputFile.required = true;

        const inputTitle = document.createElement('input');
        inputTitle.type = 'text';
        inputTitle.name = 'photo_titles[]';
        inputTitle.placeholder = 'Photo Title';
        inputTitle.classList.add('form-control', 'mb-2');
        
        // Remove button
        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.textContent = 'Remove';
        removeBtn.classList.add('btn', 'btn-danger', 'btn-sm', 'mt-2');
        removeBtn.addEventListener('click', function() {
            inputContainer.remove();
        });

        inputContainer.appendChild(inputFile);
        inputContainer.appendChild(inputTitle);
        inputContainer.appendChild(removeBtn);
        document.getElementById('photoInputs').appendChild(inputContainer);
    });
</script>
@endsection
