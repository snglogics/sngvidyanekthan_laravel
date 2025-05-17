@extends('layouts.layout') 

@section('title', 'Syllabus List')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Available Syllabuses</h2>

    @if($syllabuses->isEmpty())
        <p class="text-center">No syllabus available.</p>
    @else
        <div class="row">
            @foreach($syllabuses as $syllabus)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $syllabus->classname }} - {{ $syllabus->subject }}</h5>
                            <p class="card-text">{{ $syllabus->description }}</p>
                            <p class="card-text"><strong>Year:</strong> {{ $syllabus->academic_year }}</p>
                            @if($syllabus->pdf_url)
                                <a href="{{ $syllabus->pdf_url }}" target="_blank" class="btn btn-sm btn-primary">View PDF</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
