<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $fillable = [
        'classname',
        'pdf_url',
        'pdf_public_id'
    ];
}
