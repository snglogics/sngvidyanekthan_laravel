@csrf

<div class="mb-3">
    <label for="student_name" class="form-label">Student Name</label>
    <input type="text" name="student_name" id="student_name" class="form-control" value="{{ old('student_name', $academicPerformance->student_name ?? '') }}" required>
    @error('student_name') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label for="roll_number" class="form-label">Roll Number</label>
    <input type="text" name="roll_number" id="roll_number" class="form-control" value="{{ old('roll_number', $academicPerformance->roll_number ?? '') }}" required>
    @error('roll_number') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label for="class" class="form-label">Class</label>
    <input type="text" name="class" id="class" class="form-control" value="{{ old('class', $academicPerformance->class ?? '') }}" required>
    @error('class') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label for="section" class="form-label">Section</label>
    <input type="text" name="section" id="section" class="form-control" value="{{ old('section', $academicPerformance->section ?? '') }}">
    @error('section') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<!-- Dynamic Subjects and Marks -->
<div class="mb-3">
    <label class="form-label">Subjects and Marks</label>
    <div id="subjects-container">
        @if(isset($academicPerformance) && $academicPerformance->subjects_marks)
            @foreach(json_decode($academicPerformance->subjects_marks, true) as $subject => $marks)
                <div class="input-group mb-2">
                    <input type="text" name="subjects[]" placeholder="Subject" value="{{ $subject }}" class="form-control" required>
                    <input type="number" name="marks[]" placeholder="Marks" value="{{ $marks }}" class="form-control" required>
                    <button type="button" class="btn btn-danger remove-subject">Remove</button>
                </div>
            @endforeach
        @else
            <div class="input-group mb-2">
                <input type="text" name="subjects[]" placeholder="Subject" class="form-control" required>
                <input type="number" name="marks[]" placeholder="Marks" class="form-control" required>
                <button type="button" class="btn btn-danger remove-subject">Remove</button>
            </div>
        @endif
    </div>
    <button type="button" id="add-subject" class="btn btn-primary mb-3">Add Subject</button>
    <textarea name="subjects_marks" id="subjects_marks" class="form-control" hidden>{{ old('subjects_marks', $academicPerformance->subjects_marks ?? '') }}</textarea>
    @error('subjects_marks') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label for="total_marks" class="form-label">Total Marks</label>
    <input type="number" name="total_marks" id="total_marks" class="form-control" value="{{ old('total_marks', $academicPerformance->total_marks ?? '') }}" required>
    @error('total_marks') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label for="percentage" class="form-label">Percentage</label>
    <input type="number" step="0.01" name="percentage" id="percentage" class="form-control" value="{{ old('percentage', $academicPerformance->percentage ?? '') }}" required>
    @error('percentage') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label for="grade" class="form-label">Grade</label>
    <input type="text" name="grade" id="grade" class="form-control" value="{{ old('grade', $academicPerformance->grade ?? '') }}">
    @error('grade') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label for="performance_description" class="form-label">Performance Description</label>
    <textarea name="performance_description" id="performance_description" class="form-control">{{ old('performance_description', $academicPerformance->performance_description ?? '') }}</textarea>
    @error('performance_description') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label for="term" class="form-label">Term</label>
    <input type="text" name="term" id="term" class="form-control" value="{{ old('term', $academicPerformance->term ?? '') }}" required>
    @error('term') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label for="year" class="form-label">Year</label>
    <input type="text" name="year" id="year" class="form-control" value="{{ old('year', $academicPerformance->year ?? '') }}" required>
    @error('year') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label for="image_url" class="form-label">Image</label>
    @if(isset($academicPerformance) && $academicPerformance->image_url)
        <div class="mb-2">
            <img src="{{ $academicPerformance->image_url }}" alt="Current Image" class="img-thumbnail" style="max-height: 150px;">
        </div>
    @endif
    <input type="file" name="image_url" id="image_url" class="form-control">
    @error('image_url') <small class="text-danger">{{ $message }}</small> @enderror
</div>
