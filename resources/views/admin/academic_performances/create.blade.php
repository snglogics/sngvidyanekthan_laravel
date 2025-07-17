@extends('layouts.admin')

@section('title', 'Add Academic Performance')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .input-group .remove-subject {
            white-space: nowrap;
        }
    </style>
@endsection

@section('content')
    <div class="container my-5">
        <div class="card shadow-sm p-4">
            <h2 class="mb-4 text-center">Add Academic Performance</h2>

            <form action="{{ route('admin.academic_performances.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Basic Fields -->
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label">Student Name</label>
                        <input type="text" name="student_name" class="form-control" value="{{ old('student_name') }}"
                            required>
                    </div>
                    {{-- <div class="col-md-4">
          <label class="form-label">Roll Number</label>
          <input type="text" name="roll_number" class="form-control" value="{{ old('roll_number') }}" required>
        </div> --}}
                    <div class="col-md-2">
                        <label class="form-label">Class</label>
                        <input type="text" name="class" class="form-control" value="{{ old('class') }}" required>
                    </div>
                    {{-- <div class="col-md-2">
          <label class="form-label">Section</label>
          <input type="text" name="section" class="form-control" value="{{ old('section') }}">
        </div> --}}
                </div>

                <!-- Term & Year -->
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label class="form-label">Term</label>
                        <input type="text" name="term" class="form-control" value="{{ old('term') }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Year</label>
                        <input type="text" name="year" class="form-control" value="{{ old('year') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Performance Description</label>
                        <textarea name="performance_description" class="form-control" rows="2">{{ old('performance_description') }}</textarea>
                    </div>
                </div>

                <!-- Subjects & Marks -->
                {{-- <div class="mb-4">
        <label class="form-label">Subjects & Marks</label>
        <div id="subjects-container"></div>
        <button type="button" id="add-subject" class="btn btn-outline-secondary mb-3">
          <i class="bi bi-plus-circle"></i> Add Subject
        </button>
        <textarea name="subjects_marks" id="subjects_marks" class="d-none">{{ old('subjects_marks') }}</textarea>
      </div> --}}

                <!-- Totals -->
                <div class="row g-3 mb-4">
                    {{-- <div class="col-md-4">
          <label class="form-label">Total Marks</label>
          <input type="number" name="total_marks" class="form-control" value="{{ old('total_marks') }}" required>
        </div> --}}
                    <div class="col-md-4">
                        <label class="form-label">Percentage</label>
                        <input type="number" step="0.01" name="percentage" class="form-control"
                            value="{{ old('percentage') }}" required>
                    </div>
                    {{-- <div class="col-md-4">
          <label class="form-label">Grade</label>
          <input type="text" name="grade" class="form-control" value="{{ old('grade') }}" required>
        </div> --}}
                </div>

                <!-- Photo -->
                <div class="mb-4">
                    <label class="form-label">Upload Image (optional)</label>
                    <input type="file" name="image_url" class="form-control">
                </div>

                <button type="submit" id="submitBtn" class="btn btn-primary w-100">
                    <i class="bi bi-save"></i>
                    <span id="submitText">Add Performance</span>
                </button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const addBtn = document.getElementById('add-subject');
            const container = document.getElementById('subjects-container');
            const textarea = document.getElementById('subjects_marks');

            function syncJSON() {
                const subs = {};
                container.querySelectorAll('.subject-row').forEach(row => {
                    const subj = row.querySelector('[name="subjects[]"]').value.trim();
                    const mark = row.querySelector('[name="marks[]"]').value.trim();
                    if (subj && mark) subs[subj] = parseInt(mark);
                });
                textarea.value = JSON.stringify(subs);
            }

            function addRow(data = {}) {
                const row = document.createElement('div');
                row.className = 'input-group mb-2 subject-row';
                row.innerHTML = `
      <input type="text" name="subjects[]" class="form-control" placeholder="Subject" value="${data.subject||''}" required>
      <input type="number" name="marks[]" class="form-control" placeholder="Marks" value="${data.mark||''}" required>
      <button type="button" class="btn btn-outline-danger remove-subject">
        <i class="bi bi-trash"></i>
      </button>
    `;
                row.querySelectorAll('input').forEach(i => i.addEventListener('input', syncJSON));
                row.querySelector('.remove-subject').addEventListener('click', () => {
                    row.remove();
                    syncJSON();
                });
                container.appendChild(row);
            }

            addBtn.addEventListener('click', () => addRow());
            // initialize one row
            addRow();

            // if old data exists
            try {
                const old = JSON.parse(textarea.value);
                container.innerHTML = '';
                Object.entries(old).forEach(([subj, mark]) => addRow({
                    subject: subj,
                    mark
                }));
                syncJSON();
            } catch {}
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const btn = document.getElementById('submitBtn');
            const text = document.getElementById('submitText');

            form.addEventListener('submit', function() {
                btn.disabled = true;
                text.textContent = 'Creating...';
            });
        });
    </script>
@endsection
