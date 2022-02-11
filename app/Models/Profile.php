<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    // fillables
    protected $fillable = [
        'user_id',
        'image',
        'description',
        'title',
        'url',
    ];

    // user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
