<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'slider1', 'slider2', 'slider3',
        'slider1_heading', 'slider1_description',
        'slider2_heading', 'slider2_description',
        'slider3_heading', 'slider3_description',
    ];
} 
