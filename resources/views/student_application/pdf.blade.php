<!DOCTYPE html>
<html>
<head>
    <title>Student Application PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            font-size: 14px;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .section {
            margin-bottom: 20px;
        }
        .field {
            margin-bottom: 10px;
        }
        .label {
            font-weight: bold;
            display: inline-block;
            width: 180px;
        }
        .photo {
            margin-top: 20px;
            text-align: center;
        }
        img {
            max-width: 150px;
            max-height: 200px;
            border: 1px solid #ccc;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Student Application Form</h2>

        <div class="section">
            <div class="field"><span class="label">Pupil Name:</span> {{ $student->pupil_name }}</div>
            <div class="field"><span class="label">Class:</span> {{ $student->class }}</div>
            <div class="field"><span class="label">Gender:</span> {{ $student->gender }}</div>
            <div class="field"><span class="label">Date of Birth:</span> {{ $student->date_of_birth }}</div>
            <div class="field"><span class="label">Father's Name:</span> {{ $student->father_name }}</div>
            <div class="field"><span class="label">Mother's Name:</span> {{ $student->mother_name }}</div>
            <div class="field"><span class="label">Address:</span> {{ $student->address }}</div>
            <div class="field"><span class="label">Mobile Number:</span> {{ $student->mobile_number }}</div>
            <div class="field"><span class="label">Email:</span> {{ $student->email }}</div>
            <div class="field"><span class="label">Nationality:</span> {{ $student->nationality }}</div>
            <div class="field"><span class="label">Religion:</span> {{ $student->religion }}</div>
            <div class="field"><span class="label">Father's Occupation:</span> {{ $student->father_occupation }}</div>
            <div class="field"><span class="label">Mother's Occupation:</span> {{ $student->mother_occupation }}</div>
            <div class="field"><span class="label">Whatsapp Number:</span> {{ $student->Whatsapp_number }}</div>
            <div class="field"><span class="label">Aadhar:</span> {{ $student->aadhar }}</div>
            <div class="field"><span class="label">Annual Income:</span> {{ $student->annual_income }}</div>
            <div class="field"><span class="label">Mother Tongue:</span> {{ $student->mother_toungue }}</div>
            <div class="field"><span class="label">Father's Education:</span> {{ $student->father_education }}</div>
            <div class="field"><span class="label">Mother's Education:</span> {{ $student->mother_education }}</div>
            <div class="field"><span class="label">Total Members:</span> {{ $student->total_members }}</div>
            <div class="field"><span class="label">Siblings:</span> {{ $student->siblings }}</div>
            <div class="field"><span class="label">Local Guardian:</span> {{ $student->local_guardian }}</div>
            <div class="field"><span class="label">Hobbies:</span> {{ $student->hobbies }}</div>
            <div class="field"><span class="label">Blood Group:</span> {{ $student->blood_group }}</div>
            <div class="field"><span class="label">Boarding Point:</span> {{ $student->boarding_point }}</div>
        </div>

        <div class="photo">
            <p><strong>Photo:</strong></p>
            <img src="{{ $student->photo_url }}" alt="Student Photo">
        </div>
    </div>
</body>
</html>
