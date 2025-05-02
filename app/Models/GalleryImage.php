<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $fillable = ['image_group_id', 'image_url', 'title'];

    public function imageGroup()
    {
        return $this->belongsTo(ImageGroup::class);
    }
}
