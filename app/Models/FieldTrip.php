<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FieldTrip extends Model
{
    protected $fillable = [
        'title',
        'description',
        'location',
        'start_date',
        'end_date',
        'contact_person',
        'contact_number',
        'image_url'
    ];
}
