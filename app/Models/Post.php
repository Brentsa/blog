<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];
    //protected $fillable = ['title', 'excerpt', 'body'];

    public function category()
    {
        //A post belongs to a Category
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        //A post belongs to a User
        return $this->belongsTo(User::class);
    }
}
