<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'email',
        'socialLink1',
        'socialLink2',
        'socialLink3',
        'socialLink4',
    ];
}
