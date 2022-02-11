<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    // fillables
    protected $fillable = [
        'master_id',
        'follower_id'
    ];


    // master
    public function master()
    {
        return $this->belongsTo(User::class, "master_id", "id");
    }

    // follower
    public function follower()
    {
        return $this->belongsTo(User::class, "follower_id", "id");
    }
}
