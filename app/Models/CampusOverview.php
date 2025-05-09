<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampusOverview extends Model
{
    protected $fillable = ['main_heading', 'description', 'photos'];

    // Automatically decode the JSON photos array
    protected $casts = [
        'photos' => 'array',  // Automatically decode the JSON photos array
    ];
}
