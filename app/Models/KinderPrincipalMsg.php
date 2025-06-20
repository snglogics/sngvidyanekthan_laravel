<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KinderPrincipalMsg extends Model
{
     protected $fillable = ['image_name', 'image_header', 'description','image_url',"public_id"];
}
