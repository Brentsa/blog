<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use Exception;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    function __invoke(Newsletter $newsletter){

        //validate the incoming request to check if it is a correct email
        request()->validate([ 'email' => ['required', 'email']]);
    
        try{
            //try subscribing
            $newsletter->subscribe(request('email'));
        }
        catch(Exception $e)
        {
            //throw error if subscribe fails
            throw ValidationException::withMessages(['email' => 'This email could not be added to our newsletter.']);
        }
    
        //if successfully subscribed, flash a success message and return to home
        return redirect('/')->with('success', 'You have successfully subscribed.');
    }
}
