<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'announcement_id',
        'file_url',
        'file_type',     // Optional, if you want to store type (pdf, docx, etc.)
        'public_id',     // Optional, if using Cloudinary (to delete files easily)
    ];

    /**
     * Get the announcement that owns the file.
     */
    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }
}
