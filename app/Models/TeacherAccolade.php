<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherAccolade extends Model
{
    protected $table = 'teachers_accolades';

    protected $fillable = [
        'teacher_name',
        'title',
        'year',
        'description',
        'image_url'
    ];
    protected $primaryKey = 'id'; // This is optional if you are using 'id' as the primary key

    public function getRouteKeyName()
    {
        return 'id'; // Ensure the model uses 'id' for routing
    }
}
