<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $fillable = [
        'bus_no',
        'driver_name',
        'driver_phone',
        'attender_name',
        'attender_phone'
    ];

    public function stops()
    {
        return $this->hasMany(BusStop::class);
    }
}
