<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prefer extends Model
{
    public function users(){
        return $this->belongsTo(User::class);
    }
    public function userPrefers(){
        return $this->hasMany(UserPrefer::class,"prefer_id");
    }
}
