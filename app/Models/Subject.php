<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'title',
        'note',
        'grade_id',
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
