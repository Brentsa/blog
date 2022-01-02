<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::where('user_id', auth()->id())->orderByDesc('created_at')->get()
        ]);
    }

    public function create()
    {
        return view('admin.posts.create');
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

    public function edit(Post $post)
    {
        return view('admin.posts.edit',[
            'post' => $post
        ]);
    }

    public function update(Post $post)
    {
        $attributes = request()->validate([
            'title' => 'required',
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post->id)],
            'thumbnail' => 'image',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'excerpt' => 'required',
            'body' => 'required'
        ]);

        if(isset($attributes['thumbnail'])){
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($attributes);

        return back()->with('success', 'Post has been successfully updated.');
    }

    public function destroy(Post $post){
        $post->delete();

        return back()->with('success', 'Post has been successfully deleted.');
    }
}
