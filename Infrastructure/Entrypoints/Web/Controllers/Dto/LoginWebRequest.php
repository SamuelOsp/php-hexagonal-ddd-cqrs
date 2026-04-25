<?php

class LoginWebRequest
{
    public $email;
    public $password;

    public function __construct($email, $password)
    {
        $this->email = trim(strtolower((string)$email));
        $this->password = (string)$password;
    }
}
