@extends('layouts.admin')


@section('content')
<div class="container mt-4">
    <h2>Academic Performances</h2>
    <a href="{{  route('admin.academic_performances.create') }}" class="btn btn-primary mb-3">Add New</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Student Name</th>
                <th>Roll Number</th>
                <th>Class</th>
                <th>Year</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($performances as $performance)
            <tr>
                <td>{{ $performance->id }}</td>
                <td>{{ $performance->student_name }}</td>
                <td>{{ $performance->roll_number }}</td>
                <td>{{ $performance->class }}</td>
                <td>{{ $performance->year }}</td>
                <td>
                    <!-- <a href="{{ route('admin.academic_performances.show', $performance->id) }}" class="btn btn-info">View</a> -->
                    <a href="{{ route('admin.academic_performances.edit', $performance->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('admin.academic_performances.destroy', $performance->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection