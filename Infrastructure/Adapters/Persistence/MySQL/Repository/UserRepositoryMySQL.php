<?php

class UserRepositoryMySQL implements SaveUserPort, UpdateUserPort, DeleteUserPort, GetUserByIdPort, GetUserByEmailPort, GetAllUsersPort
{
    private $pdo;
    private $mapper;

    public function __construct(PDO $pdo, UserPersistenceMapper $mapper)
    {
        $this->pdo = $pdo;
        $this->mapper = $mapper;
    }

    public function save(UserModel $user)
    {
        $dto = $this->mapper->fromModelToDto($user);
        $entity = $this->mapper->fromDtoToEntity($dto);

        $sql = "INSERT INTO users (id, name, email, password, role, status, created_at, updated_at) 
                VALUES (:id, :name, :email, :password, :role, :status, NOW(), NOW())";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id' => $entity->id(),
            ':name' => $entity->name(),
            ':email' => $entity->email(),
            ':password' => $entity->password(),
            ':role' => $entity->role(),
            ':status' => $entity->status()
        ]);

        return $this->getById($user->id());
    }

    public function update(UserModel $user)
    {
        $dto = $this->mapper->fromModelToDto($user);
        $entity = $this->mapper->fromDtoToEntity($dto);

        $sql = "UPDATE users SET name=:name, email=:email, password=:password, role=:role, status=:status, updated_at=NOW() WHERE id=:id";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id' => $entity->id(),
            ':name' => $entity->name(),
            ':email' => $entity->email(),
            ':password' => $entity->password(),
            ':role' => $entity->role(),
            ':status' => $entity->status()
        ]);

        return $this->getById($user->id());
    }

    public function getById(UserId $id)
    {
        $sql = "SELECT id, name, email, password, role, status, created_at, updated_at FROM users WHERE id = :id LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id->value()]);
        
        $row = $stmt->fetch();
        if (!$row) {
            return null;
        }

        return $this->mapper->fromRowToModel($row);
    }

    public function getByEmail(UserEmail $email)
    {
        $sql = "SELECT id, name, email, password, role, status, created_at, updated_at FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':email' => $email->value()]);
        
        $row = $stmt->fetch();
        if (!$row) {
            return null;
        }

        return $this->mapper->fromRowToModel($row);
    }

    public function getAll()
    {
        $sql = "SELECT id, name, email, password, role, status, created_at, updated_at FROM users ORDER BY name ASC";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll();
        
        return $this->mapper->fromRowsToModels($rows);
    }

    public function delete(UserId $id)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id->value()]);
    }
}
