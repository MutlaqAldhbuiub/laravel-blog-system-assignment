<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPrefer extends Model
{
    public function prefer(){
        return $this->belongsToMany(Prefer::class);
    }

    public function user(){
        return $this->belongsTo(User::class);

    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
