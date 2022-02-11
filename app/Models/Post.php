<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // fillables
    protected $fillable = [
        'user_id',
        'image',
        'user_id',
        'caption',
    ];

    // user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
