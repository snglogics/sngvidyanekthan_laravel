<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoCurricularProgram extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category',
        'image_url',
        'start_date',
        'end_date',
        'featured'
    ];
}
