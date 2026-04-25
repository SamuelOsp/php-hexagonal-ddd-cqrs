<?php
require_once __DIR__ . '/DomainEvent.php';

class UserCreatedDomainEvent extends DomainEvent
{
    private $userId;
    private $userEmail;

    public function __construct($userId, $userEmail)
    {
        parent::__construct('user.created');
        $this->userId = $userId;
        $this->userEmail = $userEmail;
    }

    public function payload()
    {
        return [
            'id' => $this->userId,
            'email' => $this->userEmail
        ];
    }
}
