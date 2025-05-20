@extends('layouts.admin')

@section('breadcrumb-title', 'Faculty Details')
@section('breadcrumb-link', route('admin.faculty.create'))

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h3 class="mb-4 text-primary">Enter Faculty Statistics</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.faculty.store') }}">
            @csrf

            @php
                $fields = [
                    ['label' => 'Total Number of Teachers', 'name' => 'total_teachers'],
                    ['label' => 'Number of PGTs', 'name' => 'pgts'],
                    ['label' => 'Number of TGTs', 'name' => 'tgts'],
                    ['label' => 'Number of PRTs', 'name' => 'prts'],
                    ['label' => 'Number of PETs', 'name' => 'pets'],
                    ['label' => 'Other Non-Teaching Staff', 'name' => 'non_teaching'],
                    ['label' => 'Mandatory Training Qualified Teachers', 'name' => 'mandatory_training_teachers'],
                    ['label' => 'Trainings Attended Since Last Year', 'name' => 'trainings_attended'],
                ];
                $booleans = [
                    ['label' => 'Special Educator Appointed?', 'name' => 'special_educator'],
                    ['label' => 'Counsellor and Wellness Teacher Appointed?', 'name' => 'counsellor_appointed'],
                    ['label' => 'Mandatory Training Completed?', 'name' => 'mandatory_training_completed'],
                    ['label' => 'Number of NTTs?', 'name' => 'ntts'],
                ];
            @endphp

            @foreach($fields as $field)
                <div class="mb-3">
                    <label class="form-label">{{ $field['label'] }}</label>
                    <input type="number" name="{{ $field['name'] }}" class="form-control" required>
                </div>
            @endforeach

            @foreach($booleans as $field)
                <div class="mb-3">
                    <label class="form-label">{{ $field['label'] }}</label>
                    <select name="{{ $field['name'] }}" class="form-select" required>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                    </select>
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary w-100 mt-3">Save</button>
        </form>
    </div>
</div>
@endsection
