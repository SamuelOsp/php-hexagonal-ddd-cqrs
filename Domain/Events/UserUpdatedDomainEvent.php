<?php
require_once __DIR__ . '/DomainEvent.php';

class UserUpdatedDomainEvent extends DomainEvent
{
    private $userId;

    public function __construct($userId)
    {
        parent::__construct('user.updated');
        $this->userId = $userId;
    }

    public function payload()
    {
        return [
            'id' => $this->userId
        ];
    }
}
