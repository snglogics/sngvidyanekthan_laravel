@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-4 p-4">

        <div class="text-center mb-4">
            <h2 class="fw-bold text-primary mb-1">
                <i class="fas fa-school me-2"></i>SREENARAYANA VIDYANIKETAN
            </h2>
            <h4 class="text-uppercase text-secondary">
                <i class="fas fa-user-graduate me-2"></i>Senior Secondary Admissions
            </h4>
        </div>

        <form method="GET" action="{{ route('admin.senior-students.list') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by Candidate's Name"
                       value="{{ request('search') }}">
                <button class="btn btn-outline-primary" type="submit">
                    <i class="fas fa-search"></i> Search
                </button>
                <a href="{{ route('admin.senior-students.list') }}" class="btn btn-outline-secondary ms-2">
                    <i class="fas fa-redo"></i> Reset
                </a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle table-bordered text-center">
                <thead class="table-info">
                    <tr>
                        <th><i class="fas fa-hashtag"></i> ID</th>
                        <th><i class="fas fa-user"></i> Candidate's Name</th>
                        <th><i class="fas fa-id-card-alt"></i> DOB</th>
                        <th><i class="fas fa-calendar-alt"></i> Father</th>
                        <th><i class="fas fa-school"></i> Contact No</th>
                        <th><i class="fas fa-cogs"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr>
                            <td><span class="badge bg-secondary">{{ $student->id }}</span></td>
                            <td class="text-start">{{ $student->pupil_name ?: 'N/A' }}</td>
                            <td>{{ $student->date_of_birth ?: 'N/A' }}</td>
                            <td>{{ $student->father_name ?: 'N/A' }}</td>
                            <td>{{ $student->whatsapp_number ?: 'N/A' }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.senior-student.details', $student->id) }}"
                                       class="btn btn-outline-primary" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                   <form action="{{ route('admin.senior-students.destroy', $student->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this record?')"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-muted">No student data available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-4">
            {{ $students->appends(request()->query())->links() }}
        </div>

        <script>
            function printStudent(id) {
                window.open("admin.senior-student.details" + id, "_blank");
            }
        </script>
    </div>
</div>
@endsection
