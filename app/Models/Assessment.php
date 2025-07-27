<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $fillable = [
        'assessment_date',
        'assessment_type',
        'class',
        'marks',
        'duration',
        'open_house',
    ];
}
