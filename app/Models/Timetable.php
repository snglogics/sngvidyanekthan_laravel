<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    protected $fillable = [
        'classname',
        'pdf_url',
        'pdf_public_id'
    ];
}
