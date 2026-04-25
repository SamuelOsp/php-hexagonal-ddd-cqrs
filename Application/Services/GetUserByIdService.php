<?php

class GetUserByIdService implements GetUserByIdUseCase
{
    private $getUserByIdPort;

    public function __construct(GetUserByIdPort $getUserByIdPort)
    {
        $this->getUserByIdPort = $getUserByIdPort;
    }

    public function execute(GetUserByIdQuery $query)
    {
        $userId = UserApplicationMapper::fromGetUserByIdQueryToUserId($query);
        $user = $this->getUserByIdPort->getById($userId);
        if ($user === null) {
            throw UserNotFoundException::becauseIdWasNotFound($userId->value());
        }
        return $user;
    }
}
