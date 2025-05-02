<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubGallery extends Model
{
    protected $fillable = ['gallery_id', 'title', 'image'];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    
    public function imageGroups()
{
    return $this->hasMany(ImageGroup::class);
}
}
