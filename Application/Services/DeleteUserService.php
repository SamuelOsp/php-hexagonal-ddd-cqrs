<?php

class DeleteUserService implements DeleteUserUseCase
{
    private $deleteUserPort;
    private $getUserByIdPort;

    public function __construct(DeleteUserPort $deleteUserPort, GetUserByIdPort $getUserByIdPort)
    {
        $this->deleteUserPort = $deleteUserPort;
        $this->getUserByIdPort = $getUserByIdPort;
    }

    public function execute(DeleteUserCommand $command)
    {
        $userId = UserApplicationMapper::fromDeleteCommandToUserId($command);
        $existingUser = $this->getUserByIdPort->getById($userId);
        if ($existingUser === null) {
            throw UserNotFoundException::becauseIdWasNotFound($userId->value());
        }

        $this->deleteUserPort->delete($userId);
    }
}
