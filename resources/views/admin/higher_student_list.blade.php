@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg p-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary mb-1">SREENARAYANA VIDYANIKETAN</h2>
            <h4 class="text-uppercase">Student Admissions List</h4>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            <script>alert("{{ session('success') }}");</script>
        @endif

        {{-- Student List --}}
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Candidate's Name</th>
                    <th>Reg. No & Roll No</th>
                    <th>Year of Passing</th>
                    <th>Board Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->candidate_name }}</td>
                    <td>{{ $student->reg_roll_no }}</td>
                    <td>{{ $student->year_of_passing }}</td>
                    <td>{{ $student->board_type }}</td>
                    <td>
                        <a href="{{ route('admin.higher-student.details', $student->id) }}" class="btn btn-primary btn-sm">View</a>
                        <button onclick="printStudent({{ $student->id }})" class="btn btn-success btn-sm">Print</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Print Script --}}
        <script>
            function printStudent(id) {
                window.open("/admin/higher-student/print/" + id, "_blank");
            }
        </script>
    </div>
</div>
@endsection
