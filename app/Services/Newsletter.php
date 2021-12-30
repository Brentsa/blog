<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class Newsletter
{
    public function subscribe(string $email, string $list = null)
    {
        //set list to the main subscribers list if not specified as an argument
        $list ??= config('services.mailchimp.lists.subscribers');

        // Add a member to the subscribers list of emails
        return $this->getClient()->lists->addListMember($list,[
            'email_address' => $email,
            'status' => 'subscribed'
        ]);
    }

    public function getClient()
    {
        //connect to mailchimp and return the connection
        return (new ApiClient)->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us20'
        ]);
    }
}