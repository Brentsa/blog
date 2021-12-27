<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {   
        return view('register.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'username' => ['required', 'min:3', 'max:255', 'unique:users,username'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:8', 'max:255']
        ]);

        //create a user in the database
        $user = User::create($attributes);

        //log the user in
        auth()->login($user);

        // less concise version of the return statement below
        // session()->flash('success', 'Account successfully created.');
        // return redirect('/');

        //redirect user to homepage after login and flash a message
        return redirect('/')->with('success', 'Account successfully created.');
    }
}
