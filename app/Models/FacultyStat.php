<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_teachers',
        'pgts',
        'tgts',
        'prts',
        'pets',
        'non_teaching',
        'mandatory_training_teachers',
        'trainings_attended',
        'special_educator',
        'counsellor_appointed',
        'mandatory_training_completed',
        'ntts',
    ];
}
