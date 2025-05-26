<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PTAMember extends Model
{
   protected $table = 'pta_members';
   protected $fillable = ['name', 'position', 'image_url'];
}
