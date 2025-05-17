<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HigherStudentAdmission extends Model
{
    protected $fillable = [
        'candidate_name',
        'reg_roll_no',
        'year_of_passing',
        'board_type',
        'sex',
        'date_of_birth',
        'father_name',
        'father_occupation',
        'father_education',
        'mother_name',
        'mother_occupation',
        'mother_education',
        'address',
        'phone_no',
        'email',
        'last_institution',
        'medium_of_instruction',
        'mother_tongue',
        'annual_income',
        'nationality',
        'religion_caste',
        'category',
        'caste_details',
        'siblings',
        'local_guardian',
        'hobbies',
        'major_games',
        'co_curricular_achievements',
        'subjects',
        'percentages',
        'grades',
        'marks_table_image_url',
        'photo_url',
    ];
    protected $casts = [
        'subjects' => 'array',
        'percentages' => 'array',
        'grades' => 'array',
    ];
}
