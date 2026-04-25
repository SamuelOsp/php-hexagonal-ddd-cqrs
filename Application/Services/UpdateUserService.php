<?php

class UpdateUserService implements UpdateUserUseCase
{
    private $updateUserPort;
    private $getUserByIdPort;
    private $getUserByEmailPort;

    public function __construct(UpdateUserPort $updateUserPort, GetUserByIdPort $getUserByIdPort, GetUserByEmailPort $getUserByEmailPort)
    {
        $this->updateUserPort = $updateUserPort;
        $this->getUserByIdPort = $getUserByIdPort;
        $this->getUserByEmailPort = $getUserByEmailPort;
    }

    public function execute(UpdateUserCommand $command)
    {
        $userId = new UserId($command->id);
        $existingUser = $this->getUserByIdPort->getById($userId);
        if ($existingUser === null) {
            throw UserNotFoundException::becauseIdWasNotFound($userId->value());
        }

        $email = new UserEmail($command->email);
        $userWithEmail = $this->getUserByEmailPort->getByEmail($email);
        if ($userWithEmail !== null && !$userWithEmail->id()->equals($userId)) {
            throw UserAlreadyExistsException::becauseEmailAlreadyExists($email->value());
        }

        $password = $existingUser->password();
        if (trim((string)$command->password) !== '') {
            $password = UserPassword::fromPlainText($command->password);
        }

        $userModel = clone UserApplicationMapper::fromUpdateCommandToModel($command, $password);
        $this->updateUserPort->update($userModel);

        return $userModel;
    }
}
