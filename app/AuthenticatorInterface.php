<?php

namespace App;

interface AuthenticatorInterface
{
    public function check();
    
    public  function user();
}

