<?php

class GetAllUsersService implements GetAllUsersUseCase
{
    private $getAllUsersPort;

    public function __construct(GetAllUsersPort $getAllUsersPort)
    {
        $this->getAllUsersPort = $getAllUsersPort;
    }

    public function execute(GetAllUsersQuery $query)
    {
        return $this->getAllUsersPort->getAll();
    }
}
