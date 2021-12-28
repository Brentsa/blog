<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        //validate the request that was sent
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        //try to authenticate the user with the provided data
        if(auth()->attempt($attributes)){
            session()->regenerate();
            //flash the success and redirect to home
            return redirect('/')->with('success', 'Welcome Back!');
        }
        
        //send the user back with errors if log in failed
        // return back()
        //     ->withInput()
        //     ->withErrors(['email' => 'Provided credentials could not be verified.']);

        throw ValidationException::withMessages(['email' => 'Provided credentials could not be verified.']);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
