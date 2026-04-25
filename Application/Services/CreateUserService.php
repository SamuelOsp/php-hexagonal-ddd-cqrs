<?php

class CreateUserService implements CreateUserUseCase
{
    private $saveUserPort;
    private $getUserByEmailPort;

    public function __construct(SaveUserPort $saveUserPort, GetUserByEmailPort $getUserByEmailPort)
    {
        $this->saveUserPort = $saveUserPort;
        $this->getUserByEmailPort = $getUserByEmailPort;
    }

    public function execute(CreateUserCommand $command)
    {
        $email = new UserEmail($command->email);
        $existingUser = $this->getUserByEmailPort->getByEmail($email);
        if ($existingUser !== null) {
            throw UserAlreadyExistsException::becauseEmailAlreadyExists($email->value());
        }

        $userModel = UserApplicationMapper::fromCreateCommandToModel($command);
        $this->saveUserPort->save($userModel);

        return $userModel;
    }
}
