<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagerMsg extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_name',
        'description',
        'image_header',
        'image_url',
        'public_id',
    ];
}
