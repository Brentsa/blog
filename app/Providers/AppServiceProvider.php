<?php

namespace App\Providers;

use App\Models\User;
use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(Newsletter::class, function(){
            //connect to mailchimp and return the connection
            $client = (new ApiClient())->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us20'
            ]);

            return new MailchimpNewsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //remove restrictions on all models
        Model::unguard();

        //create a 'gate' that can provide authorization to admins with gate::allow or user->can
        Gate::define('admin', function (User $user){
            return $user->username == 'CodingKing';
        });

        //create a custom blade directive to gate check the user's authorization
        Blade::if('admin', function(){
            return request()->user()?->can('admin');
        });
    }
}
