<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class courses_video extends Model
{
    protected $fillable = [
        'course_id',
        'video',
    ];
    public function course()
    {
        return $this->belongsTo(courses::class, 'course_id', 'id');
    }
    
}
