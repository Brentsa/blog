<?php

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

Route::get('/', function () {
    return view('posts');
});

//wild care route to load dynamic content via $slug
Route::get('/posts/{post}', function ($slug) {

    //check if the file exists and redirect the user to the homepage if not
    if(!file_exists($path = __DIR__ . "/../resources/posts/{$slug}.html")) {
        return redirect('/');
    }

    //cache the result of file_get_get contents for a set amount of time and store in post
    $post = cache()->remember("posts.{$slug}", now()->addHour(1), fn() => file_get_contents($path));

    //return view with the variable post set
    return view('post', ['post' => $post]);

})->where('post', '[A-z_\-]+');
