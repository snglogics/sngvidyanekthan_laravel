<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClubActivity extends Model
{
    protected $fillable = [
        'title', 'description', 'image_url',
    ];
}
