<!DOCTYPE html>
<html>
<head>
    <title>Student Application</title>
</head>
<body>
    <h2>Student Application</h2>
    <p><strong>Name:</strong> {{ $student->pupil_name }}</p>
    <p><strong>Class:</strong> {{ $student->class }}</p>
    <p><strong>Gender:</strong> {{ $student->gender }}</p>
    <p><strong>Date of Birth:</strong> {{ $student->date_of_birth }}</p>
    <p><strong>Father's Name:</strong> {{ $student->father_name }}</p>
    <p><strong>Mother's Name:</strong> {{ $student->mother_name }}</p>
    <p><strong>Address:</strong> {{ $student->address }}</p>
    <p><strong>Phone:</strong> {{ $student->phone_number }}</p>
    <p><strong>Email:</strong> {{ $student->email }}</p>
    <img src="{{ $student->photo_url }}" style="max-width: 200px;">
</body>
</html>
