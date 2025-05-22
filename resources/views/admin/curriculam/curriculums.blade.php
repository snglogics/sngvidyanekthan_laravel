@extends('layouts.layout')

@section('title', 'Curriculums')
@section('hero_title')
    <i class="fas fa-book-reader text-primary me-2"></i> Our Curriculums
@endsection
@section('content')
<div class="container py-5">
   

    <div class="row">
        @foreach($curriculums as $curriculum)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-body">
                    <h5 class="card-title text-primary"><i class="fas fa-chalkboard-teacher"></i> {{ $curriculum->subject }}</h5>
                    <p class="card-subtitle mb-2 text-muted"><i class="fas fa-users"></i> {{ $curriculum->class_group }} - {{ $curriculum->term }}</p>
                    <p class="card-text"><i class="fas fa-calendar-alt"></i> {{ $curriculum->academic_year }}</p>
                    <p class="card-text"><i class="fas fa-align-left"></i> {{ Str::limit($curriculum->description, 100) }}</p>

                    @if($curriculum->document_url)
                        <a href="{{ $curriculum->document_url }}" class="btn btn-outline-primary btn-sm mb-2" target="_blank">
                            <i class="fas fa-file-pdf"></i> View Syllabus
                        </a>
                    @else
                        <span class="text-muted"><i class="fas fa-file-excel"></i> No file available</span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
