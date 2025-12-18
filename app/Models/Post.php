<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //The attributes that are mass assignable.
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'image_path',
        'category',
    ];

    // Each comment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Function to track relationship of one post to many comments
    //'numOfComments()->count();' shows how many comments it has
    public function comments()
    {
    return $this->hasMany(Comment::class);
    }
    //Each post can have many likes
    public function likes(){
        return $this->hasMany(Like::class);
    }
}
