<?php

class LoginService implements LoginUseCase
{
    private $getUserByEmailPort;

    public function __construct(GetUserByEmailPort $getUserByEmailPort)
    {
        $this->getUserByEmailPort = $getUserByEmailPort;
    }

    public function execute(LoginCommand $command)
    {
        try {
            $email = new UserEmail($command->email);
        } catch (Exception $e) {
            throw InvalidCredentialsException::becauseCredentialsAreInvalid();
        }

        $user = $this->getUserByEmailPort->getByEmail($email);
        if ($user === null || !$user->password()->verifyPlain($command->password)) {
            throw InvalidCredentialsException::becauseCredentialsAreInvalid();
        }

        if ($user->status() !== UserStatusEnum::ACTIVE) {
            throw InvalidCredentialsException::becauseUserIsNotActive();
        }

        return $user;
    }
}
