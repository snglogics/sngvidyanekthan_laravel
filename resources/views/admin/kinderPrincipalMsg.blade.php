@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>{{ $existingMsg ? 'Update' : 'Upload' }} Kinder Principal Message</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ $existingMsg ? route('admin.kinderprincipal.update', $existingMsg->id) : route('admin.kinderprincipal.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($existingMsg)
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="imageName">Principal Name</label>
            <input type="text" name="imageName" class="form-control" value="{{ old('imageName', $existingMsg->image_name ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="imageHeader">Message Header</label>
            <input type="text" name="imageHeader" class="form-control" value="{{ old('imageHeader', $existingMsg->image_header ?? '') }}">
        </div>

        <div class="form-group">
            <label for="description">Message</label>
            <textarea name="description" rows="4" class="form-control">{{ old('description', $existingMsg->description ?? '') }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Principal Image {{ $existingMsg ? '(leave blank to keep existing)' : '' }}</label>
            <input type="file" name="image" class="form-control-file" {{ $existingMsg ? '' : 'required' }}>
        </div>

        <button type="submit" class="btn btn-primary">
            {{ $existingMsg ? 'Update' : 'Upload' }}
        </button>
    </form>

    @if($existingMsg)
        <div class="mt-4">
            <h4>Current Image:</h4>
            <img src="{{ $existingMsg->image_url }}" alt="Current Image" style="max-width: 300px;">
        </div>
    @endif
</div>
@endsection
