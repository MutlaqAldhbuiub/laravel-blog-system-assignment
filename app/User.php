<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','national_id','gender'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'social' => 'array',
        "settings" => "array"
    ];


    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    /**
     * Get the posts for the blog post.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }



    public function prefers(){
        return $this->belongsToMany(Prefer::class,'user_prefers','user_id','prefer_id');
    }

    public function hasAnyPrefer($prefers){
        if (is_array($prefers)) {
            foreach ($prefers as $prefer) {
                if ($this->hasPrefer($prefer)) {
                    return true;
                }
            }
        } else {
            if ($this->hasPrefer($prefers)) {
                return true;
            }
        }
        return false;
    }


    public function hasPrefer($prefer)
    {
        if ($this->prefers()->where('title', $prefer)->first()) {
            return true;
        }
        return false;
    }

}
