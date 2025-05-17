<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterschoolParticipation extends Model
{
    protected $fillable = [
        'student_name',
        'event_name',
        'event_date',
        'position',
        'school_name',
        'remarks',
        'photo_url',
    ];
    protected $casts = [
        'event_date' => 'date',  
    ];
}
