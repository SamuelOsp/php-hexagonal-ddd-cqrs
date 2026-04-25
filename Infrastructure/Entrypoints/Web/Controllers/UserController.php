<?php

class UserController
{
    private $createUserUseCase;
    private $updateUserUseCase;
    private $getUserByIdUseCase;
    private $getAllUsersUseCase;
    private $deleteUserUseCase;
    private $mapper;

    public function __construct(
        CreateUserUseCase $createUserUseCase,
        UpdateUserUseCase $updateUserUseCase,
        GetUserByIdUseCase $getUserByIdUseCase,
        GetAllUsersUseCase $getAllUsersUseCase,
        DeleteUserUseCase $deleteUserUseCase,
        UserWebMapper $mapper
    ) {
        $this->createUserUseCase = $createUserUseCase;
        $this->updateUserUseCase = $updateUserUseCase;
        $this->getUserByIdUseCase = $getUserByIdUseCase;
        $this->getAllUsersUseCase = $getAllUsersUseCase;
        $this->deleteUserUseCase = $deleteUserUseCase;
        $this->mapper = $mapper;
    }

    public function index()
    {
        $query = new GetAllUsersQuery();
        $models = $this->getAllUsersUseCase->execute($query);
        return $this->mapper->fromModelsToResponses($models);
    }

    public function show($id)
    {
        $query = $this->mapper->fromIdToGetByIdQuery($id);
        $model = $this->getUserByIdUseCase->execute($query);
        return $this->mapper->fromModelToResponse($model);
    }

    public function store(CreateUserWebRequest $request)
    {
        $command = $this->mapper->fromCreateRequestToCommand($request);
        $model = $this->createUserUseCase->execute($command);
        return $this->mapper->fromModelToResponse($model);
    }

    public function update(UpdateUserWebRequest $request)
    {
        $command = $this->mapper->fromUpdateRequestToCommand($request);
        $model = $this->updateUserUseCase->execute($command);
        return $this->mapper->fromModelToResponse($model);
    }

    public function delete($id)
    {
        $command = $this->mapper->fromIdToDeleteCommand($id);
        $this->deleteUserUseCase->execute($command);
    }
}
