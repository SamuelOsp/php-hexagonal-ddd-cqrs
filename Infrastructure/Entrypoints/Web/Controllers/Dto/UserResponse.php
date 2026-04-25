<?php

class UserResponse
{
    public $id;
    public $name;
    public $email;
    public $role;
    public $status;

    public function __construct($id, $name, $email, $role, $status)
    {
        $this->id = (string)$id;
        $this->name = (string)$name;
        $this->email = (string)$email;
        $this->role = (string)$role;
        $this->status = (string)$status;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'status' => $this->status,
        ];
    }
}
