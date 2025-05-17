<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Syllabus extends Model
{
    protected $table = 'syllabuses';
    protected $fillable = [
        'classname', 
        'section', 
        'subject', 
        'description', 
        'pdf_url', 
        'academic_year'
    ];
}
