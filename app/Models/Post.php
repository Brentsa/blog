<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Collection;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post{

    public $title;
    public $excerpt; 
    public $date; 
    public $body; 
    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    //find a single post by it's unique slug
    public static function find($slug)
    {
        //from all the blog posts, find and return the post with the matching slug
        return static::all()->firstWhere("slug", $slug);
    }

    //find all stored post
    public static function all()
    {
        return cache()->rememberForever('posts.all', function(){
            //collect all files in the resources/posts folder, yaml parse them, then create a new post object array
            return collect(File::allFiles(resource_path("posts"))) 
                ->map(fn($file)=> YamlFrontMatter::parseFile($file))
                ->map(fn($post)=> new Post($post->title, $post->excerpt, $post->date, $post->body(), $post->slug))
                ->sortByDesc("date");
        });
    }
}