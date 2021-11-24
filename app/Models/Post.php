<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post{
    public static function find($slug){
        //check if the file exists and redirect the user to the homepage if not
        if(!file_exists($path = resource_path("/posts/${slug}.html"))) {
            throw new ModelNotFoundException();
        }

        //cache the result of file_get_get contents for a set amount of time and store in post
        return cache()->remember("posts.{$slug}", now()->addHour(1), fn() => file_get_contents($path));
    }
}