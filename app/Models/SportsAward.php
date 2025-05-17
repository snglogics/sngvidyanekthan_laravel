<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SportsAward extends Model
{
    protected $fillable = [
        'title',
        'award_year',
        'description',
        'image_url'
    ];
}
