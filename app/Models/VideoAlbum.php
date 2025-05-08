<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoAlbum extends Model
{
    protected $fillable = [
        'title',         // 👈 Add this
        'video_url',
        'public_id',
        'type',          // For distinguishing between 'album' and 'virtual_tour'
    ];
}
