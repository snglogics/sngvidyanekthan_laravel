@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Application for Admission</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('student.submit') }}" method="POST" enctype="multipart/form-data">

        @csrf
        <input name="class" class="form-control mb-3" placeholder="Class" required>
        <input name="pupil_name" class="form-control mb-3" placeholder="Pupil Name" required>
        <select name="gender" class="form-control mb-3" required>
            <option value="">Select Gender</option>
            <option value="Boy">Boy</option>
            <option value="Girl">Girl</option>
        </select>
        <input type="date" name="date_of_birth" class="form-control mb-3" required>
        <input name="father_name" class="form-control mb-3" placeholder="Father's Name" required>
        <input name="mother_name" class="form-control mb-3" placeholder="Mother's Name" required>
        <textarea name="address" class="form-control mb-3" placeholder="Address" required></textarea>
        <input name="phone_number" class="form-control mb-3" placeholder="Phone Number" required>
        <input name="email" class="form-control mb-3" placeholder="Email" required>
        <input type="file" name="photo" class="form-control mb-3" required>
        <button type="submit" class="btn btn-primary w-100">Submit</button>
    </form>
</div>
@endsection 
 