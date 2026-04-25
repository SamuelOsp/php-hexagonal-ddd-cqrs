<?php

class CreateUserWebRequest
{
    public $id;
    public $name;
    public $email;
    public $password;
    public $role;

    public function __construct($id, $name, $email, $password, $role)
    {
        $this->id = trim((string)$id);
        $this->name = trim((string)$name);
        $this->email = trim((string)$email);
        $this->password = trim((string)$password);
        $this->role = trim((string)$role);
    }
}
