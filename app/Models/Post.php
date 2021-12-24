<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];
    //protected $fillable = ['title', 'excerpt', 'body'];

    //automatically joins category and author when a post is searched, stops multiple SQL queries, solves the N+1 problem
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

    public function scopeFilter($query, array $filters) //Post::newQuery()->filter()->get()
    {
        $query->when($filters['search'] ?? false, fn($query, $search) => 
            $query->where(fn($query) => 
                $query
                ->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%')
            )
        );

        $query->when($filters['category'] ?? false, fn($query, $category) => 
            //give posts that have a category where the slug matches the filtered category
            $query->whereHas('category', fn($query) => 
                $query->where('slug', $category)
            )
        );

        $query->when($filters['author'] ?? false, fn($query, $author) => 
            $query->whereHas('author', fn($query) =>
                $query->where('username', $author)
            )
        );

        //execute if there is a search parameter
        // if(isset($filters['search'])){
        //     $query
        //     ->where('title', 'like', '%' . request('search') . '%')
        //     ->orWhere('body', 'like', '%' . request('search') . '%');
        // }
    }
}
