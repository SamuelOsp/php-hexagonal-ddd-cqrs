<?php

class UserApplicationMapper
{
    public static function fromCreateCommandToModel(CreateUserCommand $command)
    {
        return UserModel::create(
            new UserId($command->id),
            new UserName($command->name),
            new UserEmail($command->email),
            UserPassword::fromPlainText($command->password),
            $command->role
        );
    }

    public static function fromUpdateCommandToModel(UpdateUserCommand $command, UserPassword $password)
    {
        return new UserModel(
            new UserId($command->id),
            new UserName($command->name),
            new UserEmail($command->email),
            $password,
            $command->role,
            $command->status
        );
    }

    public static function fromGetUserByIdQueryToUserId(GetUserByIdQuery $query)
    {
        return new UserId($query->id);
    }

    public static function fromDeleteCommandToUserId(DeleteUserCommand $command)
    {
        return new UserId($command->id);
    }

    public static function fromModelToArray(UserModel $model)
    {
        return $model->toArray();
    }

    public static function fromModelsToArray(array $models)
    {
        $result = [];
        foreach ($models as $model) {
            $result[] = self::fromModelToArray($model);
        }
        return $result;
    }
}
