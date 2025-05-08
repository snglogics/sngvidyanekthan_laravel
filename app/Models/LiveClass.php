<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveClass extends Model
{
    protected $fillable = ['title', 'description', 'platform', 'link', 'scheduled_at'];
}
