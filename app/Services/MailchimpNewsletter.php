<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class MailchimpNewsletter implements Newsletter
{
    public function __construct(protected ApiClient $client)
    {
        //
    }

    public function subscribe(string $email, string $list = null)
    {
        //set list to the main subscribers list if not specified as an argument
        $list ??= config('services.mailchimp.lists.subscribers');

        // Add a member to the subscribers list of emails
        return $this->client->lists->addListMember($list,[
            'email_address' => $email,
            'status' => 'subscribed'
        ]);
    }
}