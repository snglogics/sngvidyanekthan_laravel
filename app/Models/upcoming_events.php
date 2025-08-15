<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class upcoming_events extends Model
{
    protected $fillable = [
        'event_date',
        'heading',
        'description',
        'time_interval',
        'venue',
        'image_url',
    ];
    
}
