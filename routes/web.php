<?php

use App\Models\Category;
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
        //stops multiple SQL queries
        'posts' => Post::with('category')->get()
    ]);
});

//wild care route to load dynamic content via Post model
Route::get('/posts/{post:slug}', function (Post $post) 
{
    //Find a post and pass it into a view called "post"
    return view('post', [
        'post' => $post
    ]); 
});

Route::get('/categories/{category:slug}', function (Category $category)
{
    return view('categories', [
        'posts' => $category->posts
    ]);
});
