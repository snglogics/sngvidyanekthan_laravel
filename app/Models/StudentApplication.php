<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentApplication extends Model
{
    protected $fillable = [
        'class', 'pupil_name', 'gender', 'date_of_birth', 'father_name',
        'mother_name', 'address', 'phone_number', 'email', 'nationality', 'religion', 'photo_url'
    ];
}
