@csrf

<div class="card shadow p-4 mb-4">
    <h4 class="mb-4"><i class="bi bi-journal-check me-2"></i>Academic Performance Details</h4>

    {{-- Student Name --}}
    <div class="mb-3">
        <label for="student_name" class="form-label"><i class="bi bi-person-fill me-1"></i>Student Name</label>
        <input type="text" name="student_name" id="student_name" class="form-control"
            value="{{ old('student_name', $academicPerformance->student_name ?? '') }}" required>
        @error('student_name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Roll Number --}}
    {{-- <div class="mb-3">
        <label for="roll_number" class="form-label"><i class="bi bi-hash me-1"></i>Roll Number</label>
        <input type="text" name="roll_number" id="roll_number" class="form-control" value="{{ old('roll_number', $academicPerformance->roll_number ?? '') }}" required>
        @error('roll_number') <small class="text-danger">{{ $message }}</small> @enderror
    </div> --}}

    {{-- Class --}}
    <div class="mb-3">
        <label for="class" class="form-label"><i class="bi bi-building me-1"></i>Class</label>
        <input type="text" name="class" id="class" class="form-control"
            value="{{ old('class', $academicPerformance->class ?? '') }}" required>
        @error('class')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Section --}}
    {{-- <div class="mb-3">
        <label for="section" class="form-label"><i class="bi bi-layout-three-columns me-1"></i>Section</label>
        <input type="text" name="section" id="section" class="form-control" value="{{ old('section', $academicPerformance->section ?? '') }}">
        @error('section') <small class="text-danger">{{ $message }}</small> @enderror
    </div> --}}

    {{-- Subjects and Marks --}}
    {{-- <div class="mb-3">
        <label class="form-label"><i class="bi bi-list-ol me-1"></i>Subjects and Marks</label>
        <div id="subjects-container">
            @if (isset($academicPerformance) && $academicPerformance->subjects_marks)
                @foreach (json_decode($academicPerformance->subjects_marks, true) as $subject => $marks)
                    <div class="input-group mb-2">
                        <input type="text" name="subjects[]" placeholder="Subject" value="{{ $subject }}" class="form-control" required>
                        <input type="number" name="marks[]" placeholder="Marks" value="{{ $marks }}" class="form-control" required>
                        <button type="button" class="btn btn-outline-danger remove-subject"><i class="bi bi-x-circle"></i></button>
                    </div>
                @endforeach
            @else
                <div class="input-group mb-2">
                    <input type="text" name="subjects[]" placeholder="Subject" class="form-control" required>
                    <input type="number" name="marks[]" placeholder="Marks" class="form-control" required>
                    <button type="button" class="btn btn-outline-danger remove-subject"><i class="bi bi-x-circle"></i></button>
                </div>
            @endif
        </div>
        <button type="button" id="add-subject" class="btn btn-outline-primary mb-3"><i class="bi bi-plus-circle"></i> Add Subject</button>
        <textarea name="subjects_marks" id="subjects_marks" class="form-control" hidden>{{ old('subjects_marks', $academicPerformance->subjects_marks ?? '') }}</textarea>
        @error('subjects_marks') <small class="text-danger">{{ $message }}</small> @enderror
    </div> --}}

    {{-- Total Marks --}}
    {{-- <div class="mb-3">
        <label for="total_marks" class="form-label"><i class="bi bi-123 me-1"></i>Total Marks</label>
        <input type="number" name="total_marks" id="total_marks" class="form-control"
            value="{{ old('total_marks', $academicPerformance->total_marks ?? '') }}" required>
        @error('total_marks')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div> --}}

    {{-- Percentage --}}
    <div class="mb-3">
        <label for="percentage" class="form-label"><i class="bi bi-percent me-1"></i>Percentage</label>
        <input type="number" step="0.01" name="percentage" id="percentage" class="form-control"
            value="{{ old('percentage', $academicPerformance->percentage ?? '') }}" required>
        @error('percentage')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Grade --}}
    {{-- <div class="mb-3">
        <label for="grade" class="form-label"><i class="bi bi-award me-1"></i>Grade</label>
        <input type="text" name="grade" id="grade" class="form-control"
            value="{{ old('grade', $academicPerformance->grade ?? '') }}">
        @error('grade')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div> --}}

    {{-- Description --}}
    <div class="mb-3">
        <label for="performance_description" class="form-label"><i class="bi bi-card-text me-1"></i>Description</label>
        <textarea name="performance_description" id="performance_description" class="form-control">{{ old('performance_description', $academicPerformance->performance_description ?? '') }}</textarea>
        @error('performance_description')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Term --}}
    <div class="mb-3">
        <label for="term" class="form-label"><i class="bi bi-calendar-event me-1"></i>Term</label>
        <input type="text" name="term" id="term" class="form-control"
            value="{{ old('term', $academicPerformance->term ?? '') }}" required>
        @error('term')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Year --}}
    <div class="mb-3">
        <label for="year" class="form-label"><i class="bi bi-calendar me-1"></i>Year</label>
        <input type="text" name="year" id="year" class="form-control"
            value="{{ old('year', $academicPerformance->year ?? '') }}" required>
        @error('year')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Image Upload --}}
    <div class="mb-3">
        <label for="image_url" class="form-label"><i class="bi bi-image me-1"></i>Image</label>
        @if (isset($academicPerformance) && $academicPerformance->image_url)
            <div class="mb-2">
                <img src="{{ $academicPerformance->image_url }}" alt="Current Image" class="img-thumbnail"
                    style="max-height: 150px;">
            </div>
        @endif
        <label>Image (optional)</label>
        <input type="file" name="image_file" class="form-control">
        @if (!empty($academicPerformance->image_url))
            <img src="{{ $academicPerformance->image_url }}" alt="Current"
                style="height:80px; margin-top:8px; object-fit:cover;">
        @endif
        @error('image_url')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
