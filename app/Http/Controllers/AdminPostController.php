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
        //validate the request and save the field data
        $attributes = $this->validatePost();

        //set the user_id to the current user
        $attributes['user_id'] = auth()->id();

        //set the thumbnail to the path of the file in it's storage location
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        Post::create($attributes);

        return redirect('/')->with('success', 'Post has been published!');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit',[
            'post' => $post
        ]);
    }

    public function update(Post $post)
    {
        //validate the request and save the field data
        $attributes = $this->validatePost($post);

        //properly update the thumbnail path and store it if a new one was entered
        if($attributes['thumbnail'] ?? false){
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        //update the post
        $post->update($attributes);

        return back()->with('success', 'Post has been successfully updated.');
    }

    public function destroy(Post $post){
        $post->delete();

        return back()->with('success', 'Post has been successfully deleted.');
    }

    protected function validatePost(Post $post = new Post()):array{
        return request()->validate([
            'title' => 'required',
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'thumbnail' => $post->exists() ? ['image'] : ['required', 'image'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'excerpt' => 'required',
            'body' => 'required'
        ]);
    }
}
