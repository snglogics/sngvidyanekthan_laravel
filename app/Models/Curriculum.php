<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    protected $fillable = [
        'class_group',
        'subject',
        'description',
        'term',
        'academic_year',
        'document_url'
    ];
}
