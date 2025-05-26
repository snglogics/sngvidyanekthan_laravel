@extends('layouts.admin')

@section('content')
<h1>Edit Club</h1>
<form action="{{ route('admin.clubs.update',$club) }}" method="POST" enctype="multipart/form-data">
  @csrf @method('PUT')
  @include('admin.clubs._form')
  <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
