<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function post() //looks for post_id
    {
        //a comment belongs to a post
        return $this->belongsTo(Post::class);
    }

    public function author() //author_id does not exist
    {
        //changing the name requires the name of the column
        return $this->belongsTo(User::class, 'user_id');
    }
}
