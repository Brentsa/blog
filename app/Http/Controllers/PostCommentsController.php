<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    public function store(Post $post)
    {
        //validate the request
        request()->validate([
            'body' => 'required'
        ]);

        //add a comment to the supplied post
        $post->comments()->create([
            'user_id' => request()->user()->id,
            'body' => request('body')
        ]);

        //send the user back to the post page
        return back();
    }
}
