@extends('layouts.layout')

@section('title', 'Class Timetable')
@section('hero_title', 'Exam Timetable')

@section('styles')
    <style>
        .toggle-header {
            cursor: pointer;
            background-color: rgba(0, 123, 255, 0.05);
            padding: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .timetable-pdf {
            padding: 1rem;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-top: none;
            border-radius: 0 0 0.5rem 0.5rem;
            margin-bottom: 1.5rem;
        }

        iframe {
            width: 100%;
            height: 600px;
            border: 1px solid #ccc;
            border-radius: 0.5rem;
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">
        <h2 class="text-primary mb-4"><i class="bi bi-calendar-week me-2"></i>All Class Exam Timetables</h2> 

        @if ($timetables->isEmpty())
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle me-2"></i>No timetables available.
            </div>
        @else
            @foreach ($timetables as $timetable)
                @php
                    $id = 'class_' . preg_replace('/\s+/', '_', strtolower($timetable->classname));
                    $inlineUrl = $timetable->pdf_url . '?fl_attachment=false'; // critical for Cloudinary PDFs
                @endphp

                <div class="mb-3">
                    <div class="toggle-header" onclick="togglePDF('{{ $id }}')">
                        <a href="{{ route('admin.timetables.view', $timetable->id) }}" class="text-decoration-none text-dark">
                            <i class="bi bi-building me-2"></i>Class {{ $timetable->classname }}
                        </a>
                        <i class="bi bi-chevron-down toggle-icon" id="icon-{{ $id }}"></i>
                    </div>

                    <div class="timetable-pdf" id="{{ $id }}" style="display: none;">
                        {{-- <iframe src="{{ $inlineUrl }}" allow="autoplay"></iframe> --}}
                        <iframe src="https://docs.google.com/gview?url={{ urlencode($timetable->pdf_url) }}&embedded=true"
                            width="100%" height="600px" frameborder="0"></iframe>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection

@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <script>
        function togglePDF(id) {
            const content = document.getElementById(id);
            const icon = document.getElementById("icon-" + id);

            const isVisible = content.style.display === "block";
            content.style.display = isVisible ? "none" : "block";
            icon.classList.toggle("bi-chevron-down", isVisible);
            icon.classList.toggle("bi-chevron-up", !isVisible);
        }
    </script>
@endsection
