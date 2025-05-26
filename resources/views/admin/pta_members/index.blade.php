@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">PTA Members</h2>
    <a href="{{ route('admin.pta-members.create') }}" class="btn btn-primary mb-3">➕ Add Member</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Position</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
                <tr>
                    <td><img src="{{ $member->image_url }}" height="60" width="60" style="object-fit:cover; border-radius:50%"></td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->position }}</td>
                    <td>
                        <a href="{{ route('admin.pta-members.edit', $member->id) }}" class="btn btn-sm btn-info">✏️ Edit</a>
                        <form action="{{ route('admin.pta-members.destroy', $member->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this member?')">🗑️ Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
