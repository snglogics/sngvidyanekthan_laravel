<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SportsGame extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category',
        'coach_name',
        'contact_number',
        'image_url'
    ];
}
