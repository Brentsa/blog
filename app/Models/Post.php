<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];
    //protected $fillable = ['title', 'excerpt', 'body'];

    //automatically joins category and author when a post is searched
    protected $with = ['category', 'author'];

    public function category()
    {
        //A post belongs to a Category
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        //A post belongs to a User
        return $this->belongsTo(User::class, 'user_id');
    }
}
