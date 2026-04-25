<?php

class UserEntity
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $role;
    private $status;
    private $createdAt;
    private $updatedAt;

    public function __construct($id, $name, $email, $password, $role, $status, $createdAt = null, $updatedAt = null)
    {
        $this->id = (string)$id;
        $this->name = (string)$name;
        $this->email = (string)$email;
        $this->password = (string)$password;
        $this->role = (string)$role;
        $this->status = (string)$status;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function id() { return $this->id; }
    public function name() { return $this->name; }
    public function email() { return $this->email; }
    public function password() { return $this->password; }
    public function role() { return $this->role; }
    public function status() { return $this->status; }
    public function createdAt() { return $this->createdAt; }
    public function updatedAt() { return $this->updatedAt; }
}
