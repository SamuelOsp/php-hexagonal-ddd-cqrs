<?php

class UserPersistenceDto
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $role;
    private $status;

    public function __construct($id, $name, $email, $password, $role, $status)
    {
        $this->id = (string)$id;
        $this->name = (string)$name;
        $this->email = (string)$email;
        $this->password = (string)$password;
        $this->role = (string)$role;
        $this->status = (string)$status;
    }

    public function id() { return $this->id; }
    public function name() { return $this->name; }
    public function email() { return $this->email; }
    public function password() { return $this->password; }
    public function role() { return $this->role; }
    public function status() { return $this->status; }
}
