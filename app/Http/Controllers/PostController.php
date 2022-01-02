<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        //pass an array of posts to the posts view
        return view('posts.index', [
            'posts' => Post::latest()->filter(
                request(['search', 'category', 'author'])
            )->paginate(6)->withQueryString()
        ]);
    }

    public function show(Post $post)
    {
        //Find a post and pass it into a view called "post"
        return view('posts.show', [
            'post' => $post
        ]); 
    }

    // 7 restful actions index, show, create, store, edit, update, destroy
}
