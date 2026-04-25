<?php

class UserPersistenceMapper
{
    public function fromModelToDto(UserModel $model)
    {
        return new UserPersistenceDto(
            $model->id()->value(),
            $model->name()->value(),
            $model->email()->value(),
            $model->password()->value(),
            $model->role(),
            $model->status()
        );
    }

    public function fromDtoToEntity(UserPersistenceDto $dto)
    {
        return new UserEntity(
            $dto->id(),
            $dto->name(),
            $dto->email(),
            $dto->password(),
            $dto->role(),
            $dto->status()
        );
    }

    public function fromRowToEntity(array $row)
    {
        return new UserEntity(
            $row['id'],
            $row['name'],
            $row['email'],
            $row['password'],
            $row['role'],
            $row['status'],
            $row['created_at'] ?? null,
            $row['updated_at'] ?? null
        );
    }

    public function fromEntityToModel(UserEntity $entity)
    {
        return new UserModel(
            new UserId($entity->id()),
            new UserName($entity->name()),
            new UserEmail($entity->email()),
            UserPassword::fromHash($entity->password()),
            $entity->role(),
            $entity->status()
        );
    }

    public function fromRowToModel(array $row)
    {
        return $this->fromEntityToModel($this->fromRowToEntity($row));
    }

    public function fromRowsToModels(array $rows)
    {
        $models = [];
        foreach ($rows as $row) {
            $models[] = $this->fromRowToModel($row);
        }
        return $models;
    }
}
