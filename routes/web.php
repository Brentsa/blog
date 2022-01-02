<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;

//Standard Routes------------------------------------------

//Home route
Route::get('/', [PostController::class, 'index'])->name('home');

//Route to test mailchimp functionality, laravel will instantiate a newsletter
Route::post('/newsletter', NewsletterController::class);

//Load the main page with blog posts
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('post');

//Add a comment to a post
Route::post('/posts/{post:slug}/comments', [PostCommentsController::class, 'store'])->middleware('auth');

//Register user page and the route to post a new user to the DB
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

//Login user page and the route to create a new session
Route::get('/login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('/session', [SessionsController::class, 'store'])->middleware('guest');

//Route to log the user out and destroy the session
Route::post('/logout', [SessionsController::class, 'destroy'])->middleware('auth');



//Admin Routes------------------------------------------
Route::middleware('can:admin')->group(function(){
    //Define all 7 types of routes for posts in a single line
    //Route::resource('/admin/posts', AdminPostController::class)->except('show');

    //Admin dashboard page
    Route::get('/admin/posts', [AdminPostController::class, 'index']);

    //Create a post route
    Route::get('/admin/posts/create', [AdminPostController::class, 'create']);
    Route::post('/admin/posts', [AdminPostController::class, 'store']);

    //Edit a post route
    Route::get('/admin/posts/{post}/edit', [AdminPostController::class, 'edit']);
    Route::patch('/admin/posts/{post}', [AdminPostController::class, 'update']);

    //Delete a post route
    Route::delete('/admin/posts/{post}', [AdminPostController::class, 'destroy']);
});
