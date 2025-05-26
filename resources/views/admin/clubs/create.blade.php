@extends('layouts.admin')

@section('content')
<h1>Create New Club</h1>
<form action="{{ route('admin.clubs.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  @include('admin.clubs._form')
  <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection
