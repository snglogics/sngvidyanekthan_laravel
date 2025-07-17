<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadEvents extends Model
{
    protected $table = 'event_upload';

    protected $fillable = [
        'common_header',
        'description',
        'header',
        'image_url',
    ];
}
