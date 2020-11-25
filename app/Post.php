<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $dates = [
        'created_at',
        'updated_at',
    ];


    /**
     * Get the post that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the comments for the blog post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }





}
