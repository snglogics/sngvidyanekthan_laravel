@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between mb-3">
  <h1>Club Activities</h1>
  <a href="{{ route('admin.clubs.create') }}" class="btn btn-primary">+ New Club</a>
</div>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
  <thead>
    <tr><th>Title</th><th>Image</th><th>Actions</th></tr>
  </thead>
  <tbody>
    @forelse($clubs as $club)
    <tr>
      <td>{{ $club->title }}</td>
      <td>
        @if($club->image_url)
          <img src="{{ $club->image_url }}" width="80" alt="">
        @endif
      </td>
      <td>
        <a href="{{ route('admin.clubs.edit',$club) }}" class="btn btn-sm btn-warning">Edit</a>
        <form action="{{ route('admin.clubs.destroy',$club) }}" method="POST" class="d-inline"
              onsubmit="return confirm('Delete this club?')">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-danger">Delete</button>
        </form>
      </td>
    </tr>
    @empty
      <tr><td colspan="3">No clubs yet.</td></tr>
    @endforelse
  </tbody>
</table>

{{ $clubs->links() }}
@endsection
