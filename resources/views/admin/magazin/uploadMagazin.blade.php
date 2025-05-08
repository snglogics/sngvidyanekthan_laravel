@extends('layouts.admin')

@section('title', 'Manage Announcements')

@section('styles')
<link href="{{ asset('frontend/css/uploadPrincipal.css') }}" rel="stylesheet">
@endsection

@section('content')

<form action="{{ route('admin.magazines.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="title" placeholder="Magazine Title" required class="form-control mb-2">
    <input type="file" name="pdf" accept="application/pdf" required class="form-control mb-2">
    <button class="btn btn-primary">Upload Magazine</button>
</form>
@endsection