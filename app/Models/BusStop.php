<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusStop extends Model
{
    protected $fillable = [
        'bus_id',
        'stop_name',
        'morning_time',
        'evening_time'
    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
}
