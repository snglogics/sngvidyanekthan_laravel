@extends('layouts.layout')

@section('title', 'Class Timetable')
@section('hero_title', 'Class Timetable')

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
            transition: background-color 0.2s;
        }

        .toggle-header:hover {
            background-color: rgba(0, 123, 255, 0.1);
        }

        .timetable-pdf {
            padding: 1rem;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-top: none;
            border-radius: 0 0 0.5rem 0.5rem;
            margin-bottom: 1.5rem;
        }

        .pdf-viewer {
            width: 100%;
            height: 600px;
            border: 1px solid #ccc;
            border-radius: 0.5rem;
        }

        .pdf-options {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        .pdf-option-btn {
            padding: 5px 10px;
            background: #f0f0f0;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
        }

        .pdf-option-btn.active {
            background: #007bff;
            color: white;
        }

        .alert-pdf {
            padding: 15px;
            background: #fff8e1;
            border-left: 4px solid #ffc107;
            margin-bottom: 15px;
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">
        <h2 class="text-primary mb-4"><i class="bi bi-calendar-week me-2"></i>All Class Timetables</h2>

        @if ($timetables->isEmpty())
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle me-2"></i>No timetables available.
            </div>
        @else
            @foreach ($timetables as $timetable)
                @php
                    $id = 'class_' . preg_replace('/\s+/', '_', strtolower($timetable->classname));
                    // Cloudinary direct PDF URL
                    $directUrl = $timetable->pdf_url;
                    // Cloudinary PDF with forced inline display
                    $inlineUrl = $timetable->pdf_url . '?fl_attachment=false';
                    // Google Docs Viewer URL
                    $googleViewerUrl =
                        'https://docs.google.com/gview?url=' . urlencode($timetable->pdf_url) . '&embedded=true';
                @endphp

                <div class="mb-3">
                    <div class="toggle-header" onclick="togglePDF('{{ $id }}')">
                        <span><i class="bi bi-building me-2"></i>{{ $timetable->classname }}</span>
                        <i class="bi bi-chevron-down toggle-icon" id="icon-{{ $id }}"></i>
                    </div>

                    <div class="timetable-pdf" id="{{ $id }}" style="display: none;">
                        <div class="alert-pdf">
                            <i class="bi bi-info-circle me-2"></i>
                            If the PDF doesn't load, try a different viewer option below.
                        </div>

                        <div class="pdf-options">
                            <button class="pdf-option-btn active"
                                onclick="changeViewer('{{ $id }}_viewer', 'direct', '{{ $inlineUrl }}')">Direct
                                View</button>
                            <button class="pdf-option-btn"
                                onclick="changeViewer('{{ $id }}_viewer', 'google', '{{ $googleViewerUrl }}')">Google
                                Viewer</button>
                            <button class="pdf-option-btn"
                                onclick="changeViewer('{{ $id }}_viewer', 'download')">Download Instead</button>
                        </div>

                        <div id="{{ $id }}_viewer">
                            <iframe class="pdf-viewer" src="{{ $inlineUrl }}" allow="autoplay"></iframe>
                        </div>
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

        function changeViewer(containerId, type, url = null) {
            const container = document.getElementById(containerId);
            const buttons = container.parentElement.querySelectorAll('.pdf-option-btn');

            // Update active button
            buttons.forEach(btn => {
                btn.classList.remove('active');
                if (btn.textContent.toLowerCase().includes(type)) {
                    btn.classList.add('active');
                }
            });

            // Change viewer based on type
            if (type === 'download') {
                container.innerHTML = `
                    <div class="text-center py-4">
                        <p class="mb-3">The timetable will download automatically.</p>
                        <a href="${url || container.querySelector('iframe').src}" 
                           class="btn btn-primary" 
                           download target="_blank">
                            <i class="bi bi-download me-2"></i>Download Now
                        </a>
                    </div>
                `;
            } else {
                container.innerHTML = `
                    <iframe class="pdf-viewer" src="${url}" allow="autoplay"></iframe>
                `;
            }
        }
    </script>
@endsection
