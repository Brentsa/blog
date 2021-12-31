<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Validation\Rule;

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

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required',
            'slug' => ['required', Rule::unique('posts', 'slug')],
            'thumbnail' => ['required', 'image'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'excerpt' => 'required',
            'body' => 'required'
        ]);

        //set the user_id to the current user
        $attributes['user_id'] = auth()->id();

        //set the thumbnail to the path of the file in it's storage location
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        Post::create($attributes);

        return redirect('/');
    }

    // 7 restful actions index, show, create, store, edit, update, destroy
}
