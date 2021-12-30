<?php

namespace App\Services;

//create a contract for all newsletter services
interface Newsletter
{
    //every newsletter must have a subscribe function that takes in an email and list
    public function subscribe(string $email, string $list = null);
}