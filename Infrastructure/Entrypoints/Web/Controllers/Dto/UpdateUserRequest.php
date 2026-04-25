<?php

class UpdateUserWebRequest
{
    public $id;
    public $name;
    public $email;
    public $password;
    public $role;
    public $status;

    public function __construct($id, $name, $email, $password, $role, $status)
    {
        $this->id = trim((string)$id);
        $this->name = trim((string)$name);
        $this->email = trim((string)$email);
        $this->password = (string)$password;
        $this->role = trim((string)$role);
        $this->status = trim((string)$status);
    }
}
