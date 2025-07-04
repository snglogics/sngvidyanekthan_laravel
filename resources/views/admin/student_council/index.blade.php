@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h4 mb-0">Student Council Members</h1>
            <a href="{{ route('admin.student_council.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Add Member
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">
            @forelse ($studentCouncils as $member)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm">
                        @if ($member->photo)
                            <img src="{{ $member->photo }}" alt="{{ $member->student_name }}" class="card-img-top img-fluid"
                                style="height: 200px; object-fit: cover;">
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                                <span class="text-muted">No Photo</span>
                            </div>
                        @endif

                        <div class="card-body text-center d-flex flex-column">
                            <h5 class="card-title mb-1">{{ $member->student_name }}</h5>
                            <span class="badge bg-primary mb-3">{{ $member->position }}</span>

                            <div class="mt-auto d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.student_council.edit', $member->id) }}"
                                    class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('admin.student_council.destroy', $member->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this member?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">No student council members found.</div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
