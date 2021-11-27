<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () 
{
    //pass an array of posts to the posts view
    return view('posts', [
        'posts' => Post::all()
    ]);
});

//wild care route to load dynamic content via $slug
Route::get('/posts/{post}', function ($id) 
{
    //Find a post by its slug and pass it into a view called "post"
    return view('post', [
        'post' => Post::findOrFail($id)
    ]); 
});
