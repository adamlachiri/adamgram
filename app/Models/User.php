<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // create profile
    protected static function boot()
    {

        parent::boot();

        static::created(function ($user) {
            $user->profile()->create([
                "user_id" => $user->id
            ]);
        });
    }

    // posts
    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy("created_at", "desc");
    }

    // profile
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // masters
    public function masters()
    {
        return $this->hasMany(Follow::class, "follower_id", "id");
    }

    // followers
    public function followers()
    {
        return $this->hasMany(Follow::class, "master_id", "id");
    }

    // likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
