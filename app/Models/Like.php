<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Like extends Model
{
    use HasFactory;

    //The attributes that are mass assignable.
    protected $fillable = [
        'user_id',
        'post_id',
    ];

    // Relationships:
    // Each like belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Each like belongs to a post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
