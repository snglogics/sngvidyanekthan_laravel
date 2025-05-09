<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentApplication extends Model
{
    protected $fillable = [
        'class',
        'pupil_name',
        'gender',
        'date_of_birth',
        'father_name',
        'father_occupation',
        'mother_name',
        'mother_occupation',
        'address',
        'mobile_number',
        'Whatsapp_number',
        'aadhar',
        'email',
        'annual_income',
        'nationality',
        'religion',
        'mother_toungue',
        'father_education',
        'mother_education',
        'total_members',
        'siblings',
        'local_guardian',
        'hobbies',
        'blood_group',
        'boarding_point',
        'photo_url'
    ];
}
