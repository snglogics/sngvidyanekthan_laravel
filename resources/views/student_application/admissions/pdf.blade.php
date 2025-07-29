<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Student Admission Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            color: #333;
        }

        h2,
        h4 {
            color: #2c3e50;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        img {
            width: 120px;
            height: 140px;
            object-fit: cover;
            border: 2px solid #000;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <h2>SIVAGIRI VIDYANIKETAN</h2>
    <h4>Student Admission Form</h4>

    @if ($student->photo_url)
        <div style="text-align: center;">
            <img src="{{ $student->photo_url }}" alt="Student Photo">
        </div>
    @endif

    <table>
        <tr>
            <th>Class to which admission is sought</th>
            <td>{{ $student->admission_class }}</td>
        </tr>
        <tr>
            <th>Student's Name</th>
            <td>{{ $student->pupil_name }}</td>
        </tr>
        <tr>
            <th>Gender</th>
            <td>{{ $student->gender }}</td>
        </tr>
        <tr>
            <th>Date of Birth</th>
            <td>{{ $student->date_of_birth }}</td>
        </tr>
        <tr>
            <th>Aadhaar No.</th>
            <td>{{ $student->aadhaar_no }}</td>
        </tr>
        <tr>
            <th>Father's Name</th>
            <td>{{ $student->father_name }}</td>
        </tr>
        <tr>
            <th>Father's Occupation</th>
            <td>{{ $student->father_occupation }}</td>
        </tr>
        <tr>
            <th>Mother's Name</th>
            <td>{{ $student->mother_name }}</td>
        </tr>
        <tr>
            <th>Mother's Occupation</th>
            <td>{{ $student->mother_occupation }}</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>{{ $student->address }}</td>
        </tr>
        <tr>
            <th>Phone No.</th>
            <td>{{ $student->phone_number }}</td>
        </tr>
        <tr>
            <th>Whatsapp No.</th>
            <td>{{ $student->whatsapp_number }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $student->email }}</td>
        </tr>
        <tr>
            <th>Annual Income</th>
            <td>{{ $student->annual_income }}</td>
        </tr>
        <tr>
            <th>Nationality</th>
            <td>{{ $student->nationality }}</td>
        </tr>
        <tr>
            <th>Religion & Caste</th>
            <td>{{ $student->religion_caste }}</td>
        </tr>
        <tr>
            <th>Mother Tongue</th>
            <td>{{ $student->mother_tongue }}</td>
        </tr>
        <tr>
            <th>Family Members</th>
            <td>{{ $student->family_members }}</td>
        </tr>
        <tr>
            <th>Immunization Status</th>
            <td>{{ $student->immunization_status }}</td>
        </tr>
        <tr>
            <th>Local Guardian</th>
            <td>{{ $student->local_guardian }}</td>
        </tr>
        <tr>
            <th>Hobbies</th>
            <td>{{ $student->hobbies }}</td>
        </tr>
        <tr>
            <th>Games Played</th>
            <td>{{ $student->games_played }}</td>
        </tr>
        <tr>
            <th>Co-curricular Achievements</th>
            <td>{{ $student->cocurricular_achievements }}</td>
        </tr>
        <tr>
            <th>CCA Options</th>
            <td>{{ $student->cca_options }}</td>
        </tr>
        <tr>
            <th>Year of Passing</th>
            <td>{{ $student->year_of_passing }}</td>
        </tr>
        <tr>
            <th>Total Marks</th>
            <td>{{ $student->total_marks }}</td>
        </tr>
    </table>

    <p>Generated on: {{ now()->format('d-m-Y') }}</p>

</body>

</html>
