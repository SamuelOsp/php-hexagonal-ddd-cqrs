<?php
require_once __DIR__ . '/../ValueObjects/UserId.php';
require_once __DIR__ . '/../ValueObjects/UserName.php';
require_once __DIR__ . '/../ValueObjects/UserEmail.php';
require_once __DIR__ . '/../ValueObjects/UserPassword.php';
require_once __DIR__ . '/../Enums/UserRoleEnum.php';
require_once __DIR__ . '/../Enums/UserStatusEnum.php';

class UserModel
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $role;
    private $status;

    public function __construct(UserId $id, UserName $name, UserEmail $email, UserPassword $password, $role, $status)
    {
        UserRoleEnum::ensureIsValid($role);
        UserStatusEnum::ensureIsValid($status);

        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->status = $status;
    }

    public static function create(UserId $id, UserName $name, UserEmail $email, UserPassword $password, $role)
    {
        return new self($id, $name, $email, $password, $role, UserStatusEnum::PENDING);
    }

    public function activate()
    {
        return new self($this->id, $this->name, $this->email, $this->password, $this->role, UserStatusEnum::ACTIVE);
    }

    public function deactivate()
    {
        return new self($this->id, $this->name, $this->email, $this->password, $this->role, UserStatusEnum::INACTIVE);
    }

    public function block()
    {
        return new self($this->id, $this->name, $this->email, $this->password, $this->role, UserStatusEnum::BLOCKED);
    }

    public function changeName(UserName $newName)
    {
        return new self($this->id, $newName, $this->email, $this->password, $this->role, $this->status);
    }

    public function changeEmail(UserEmail $newEmail)
    {
        return new self($this->id, $this->name, $newEmail, $this->password, $this->role, $this->status);
    }

    public function changePassword(UserPassword $newPassword)
    {
        return new self($this->id, $this->name, $this->email, $newPassword, $this->role, $this->status);
    }

    public function changeRole($newRole)
    {
        UserRoleEnum::ensureIsValid($newRole);
        return new self($this->id, $this->name, $this->email, $this->password, $newRole, $this->status);
    }

    public function id()
    {
        return $this->id;
    }

    public function name()
    {
        return $this->name;
    }

    public function email()
    {
        return $this->email;
    }

    public function password()
    {
        return $this->password;
    }

    public function role()
    {
        return $this->role;
    }

    public function status()
    {
        return $this->status;
    }

    public function toArray()
    {
        return [
            'id' => $this->id->value(),
            'name' => $this->name->value(),
            'email' => $this->email->value(),
            'password' => $this->password->value(),
            'role' => $this->role,
            'status' => $this->status,
        ];
    }
}
