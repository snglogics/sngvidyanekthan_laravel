<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicCalendar extends Model
{
    protected $fillable = [
        'event_name',
        'description',
        'start_date',
        'end_date',
        'event_type',
        'academic_year',
        'audience',
        'color',
        'attachment_url'
    ];
}
