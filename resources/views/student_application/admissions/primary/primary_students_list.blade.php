@extends('layouts.admin')

@section('content')
<div class="container py-5">
  <div class="card shadow-lg rounded-4 p-4">
    <div class="text-center mb-4">
      <h2 class="fw-bold text-primary mb-1">
        <i class="fas fa-school me-2"></i>SREENARAYANA VIDYANIKETAN
      </h2>
      <h4 class="text-uppercase text-secondary">
        <i class="fas fa-user-graduate me-2"></i>Primary School Applications
      </h4>
    </div>

    <form method="GET" action="{{ route('admin.primary-students.list') }}" class="mb-4">
      <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search by Name" 
               value="{{ request('search') }}">
        <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i> Search</button>
        <a href="{{ route('admin.primary-students.list') }}" class="btn btn-outline-secondary ms-2">
          <i class="fas fa-redo"></i> Reset
        </a>
      </div>
    </form>

    <div class="table-responsive">
      <table class="table table-hover align-middle table-bordered text-center">
        <thead class="table-info">
          <tr>
            <th><i class="fas fa-hashtag"></i> ID</th>
            <th><i class="fas fa-user"></i> Name</th>
            <th><i class="fas fa-calendar-alt"></i> DOB</th>
            <th><i class="fas fa-phone"></i> Mobile</th>
            <th><i class="fas fa-envelope"></i> Email</th>
            <th><i class="fas fa-cogs"></i> Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($students as $stu)
            <tr id="student-row-{{ $stu->id }}">
              <td><span class="badge bg-secondary">{{ $stu->id }}</span></td>
              <td class="text-start">{{ $stu->pupil_name ?: 'N/A' }}</td>
              <td>{{ $stu->date_of_birth ?: 'N/A' }}</td>
              <td>{{ $stu->mobile_number ?: 'N/A' }}</td>
              <td>{{ $stu->email ?: 'N/A' }}</td>
              <td>
                <div class="btn-group btn-group-sm">
                  <a href="{{ route('admin.primary-students.show', $stu->id) }}"
                     class="btn btn-outline-primary" title="View Details">
                    <i class="fas fa-eye"></i>
                  </a>
                  <form action="{{ route('admin.primary-students.destroy', $stu->id) }}"
                        method="POST" class="d-inline"
                        onsubmit="return confirm('Delete this application?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger" title="Delete">
                      <i class="fas fa-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-muted">No applications found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="d-flex justify-content-end mt-4">
      {{ $students->appends(request()->query())->links() }}
    </div>
  </div>
</div>
@endsection
