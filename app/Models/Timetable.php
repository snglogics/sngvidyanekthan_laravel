<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    protected $fillable = [
        'classname',
        'section',
        'day',
        'period_number',
        'subject',
        'teacher_name',
        'start_time',
        'end_time',
        'room_number'
    ];
}
