<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeniorStudentAdmission extends Model
{
    protected $table = 'student_admissions';
    protected $fillable = [
        'admission_class',
        'pupil_name',
        'gender',
        'date_of_birth',
        'aadhaar_no',
        'father_name',
        'father_occupation',
        'mother_name',
        'mother_occupation',
        'address',
        'phone_number',
        'whatsapp_number',
        'email',
        'annual_income',
        'nationality',
        'religion_caste',
        'last_institution_attended',
        'medium_of_instruction',
        'mother_tongue',
        'parent_education',
        'family_members',
        'siblings',
        'immunization_status',
        'local_guardian',
        'hobbies',
        'games_played',
        'cocurricular_achievements',
        'cca_options',
        'year_of_passing',
        'total_marks',
        'photo_url',
        'pdf_url',
    ];
}
