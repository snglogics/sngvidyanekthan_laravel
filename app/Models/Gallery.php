<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'main_image'];

    /**
     * Get all files attached to this announcement.
     */
    // Gallery.php
public function subGalleries() {
    return $this->hasMany(SubGallery::class);
}
    
}
 