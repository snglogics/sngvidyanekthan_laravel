<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CulturalCompetition extends Model
{
    protected $fillable = [
        'title',
        'competition_year',
        'description',
        'image_url'
    ];
}
