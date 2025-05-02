<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageGroup extends Model
{
    protected $fillable = ['sub_gallery_id', 'title'];

    public function images()
    {
        return $this->hasMany(GalleryImage::class);
    }

    public function subGallery()
    {
        return $this->belongsTo(SubGallery::class);
    }
}
