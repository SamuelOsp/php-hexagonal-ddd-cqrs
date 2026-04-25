<?php

class UserWebMapper
{
    public function fromCreateRequestToCommand(CreateUserWebRequest $request)
    {
        return new CreateUserCommand(
            $request->id,
            $request->name,
            $request->email,
            $request->password,
            $request->role
        );
    }

    public function fromUpdateRequestToCommand(UpdateUserWebRequest $request)
    {
        return new UpdateUserCommand(
            $request->id,
            $request->name,
            $request->email,
            $request->password,
            $request->role,
            $request->status
        );
    }

    public function fromIdToGetByIdQuery($id)
    {
        return new GetUserByIdQuery(trim((string)$id));
    }

    public function fromIdToDeleteCommand($id)
    {
        return new DeleteUserCommand(trim((string)$id));
    }

    public function fromModelToResponse(UserModel $model)
    {
        return new UserResponse(
            $model->id()->value(),
            $model->name()->value(),
            $model->email()->value(),
            $model->role(),
            $model->status()
        );
    }

    public function fromModelsToResponses(array $models)
    {
        $responses = [];
        foreach ($models as $model) {
            $responses[] = $this->fromModelToResponse($model);
        }
        return $responses;
    }
}
