<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'header',
        'description',
    ];

    /**
     * Get all files attached to this announcement.
     */
    public function files()
    {
        return $this->hasMany(AnnouncementFile::class);
    }
    
}
