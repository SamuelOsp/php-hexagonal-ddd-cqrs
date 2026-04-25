<?php

class CreateUserCommand
{
    public $id;
    public $name;
    public $email;
    public $password;
    public $role;

    public function __construct($id, $name, $email, $password, $role)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }
}
