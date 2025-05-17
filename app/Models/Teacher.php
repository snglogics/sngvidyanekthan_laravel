<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['name',
        'designation',
        'experience',
        'qualification',
        'department',
        'subject',
        'description',
        'photo'];
}
