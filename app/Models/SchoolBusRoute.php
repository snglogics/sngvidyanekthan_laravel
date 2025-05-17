<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolBusRoute extends Model
{
    protected $fillable = [
        'route_name',
        'description',
        'stops',
        'driver_name',
        'driver_contact',
        'bus_number',
        'bus_image_url'
    ];

    protected $casts = [
        'stops' => 'array',
    ];
}
