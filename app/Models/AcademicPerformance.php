<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicPerformance extends Model
{
    protected $fillable = [
        'student_name',
        'roll_number',
        'class',
        'section',
        'subjects_marks',
        'total_marks',
        'percentage',
        'grade',
        'performance_description',
        'term',
        'year',
        'image_url'
    ];
  
   
}
