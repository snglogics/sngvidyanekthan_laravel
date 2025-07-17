@extends('layouts.admin')

@section('content')
    <div class="container py-5">
        <div class="card shadow-lg border-0 rounded-4 p-4">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-primary mb-1">
                    <i class="fas fa-school me-2"></i>SIVAGIRI VIDYANIKETAN
                </h2>
                <h4 class="text-uppercase text-secondary">
                    <i class="fas fa-users me-2"></i>Student Admissions List
                </h4>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <script>
                    alert("{{ session('success') }}");
                </script>
            @endif
            <form method="GET" action="{{ route('admin.higher-students.list') }}" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by Candidate's Name"
                        value="{{ request('search') }}">
                    <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i> Search</button>
                </div>
            </form>
            {{-- Student List --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle table-bordered text-center">
                    <thead class="table-primary">
                        <tr>
                            <th><i class="fas fa-hashtag"></i> ID</th>
                            <th><i class="fas fa-user"></i> Candidate's Name</th>
                            <th><i class="fas fa-id-card-alt"></i> Reg. No & Roll No</th>
                            <th><i class="fas fa-calendar-alt"></i> Year of Passing</th>
                            <th><i class="fas fa-university"></i> Board Type</th>
                            <th><i class="fas fa-cogs"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td><span class="badge bg-secondary">{{ $student->id }}</span></td>
                                <td class="text-start">{{ $student->candidate_name }}</td>
                                <td>{{ $student->reg_roll_no }}</td>
                                <td>{{ $student->year_of_passing }}</td>
                                <td>{{ $student->board_type }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.higher-student.details', $student->id) }}"
                                            class="btn btn-outline-primary" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button onclick="printStudent({{ $student->id }})" class="btn btn-outline-success"
                                            title="Print">
                                            <i class="fas fa-print"></i>
                                        </button>
                                        <form action="{{ route('admin.higher-students.destroy', $student->id) }}"
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
                <div class="d-flex justify-content-end mt-4">
                    {{ $students->appends(request()->query())->links() }}
                </div>

            </div>

            {{-- Print Script --}}
            <script>
                function printStudent(id) {
                    window.open("/admin/higher-student/print/" + id, "_blank");
                }
            </script>
        </div>
    </div>
@endsection
